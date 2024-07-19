<?php

namespace FriendsOfBotble\Iyzipay\Http\Controllers;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\CheckoutForm;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Locale;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveCheckoutFormRequest;
use FriendsOfBotble\Iyzipay\Services\Iyzipay;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Repositories\Interfaces\OrderHistoryInterface;
use Botble\Ecommerce\Repositories\Interfaces\OrderInterface;
use Botble\Ecommerce\Repositories\Interfaces\OrderProductInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Supports\PaymentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IyzipayController extends BaseController
{
    public function getCallback(Request $request, BaseHttpResponse $response, Iyzipay $iyzipay)
    {
        $paymentRequest = new RetrieveCheckoutFormRequest();
        $paymentRequest->setLocale(Locale::EN);
        $paymentRequest->setToken($request->input('token'));

        $checkoutForm = CheckoutForm::retrieve($paymentRequest, $iyzipay->getCredentials());

        if ($checkoutForm->getStatus() !== 'success') {
            return $response
                ->setError()
                ->setNextUrl(PaymentHelper::getCancelURL())
                ->setMessage($checkoutForm->getErrorMessage());
        }

        do_action(PAYMENT_ACTION_PAYMENT_PROCESSED, [
            'amount' => $checkoutForm->getPaidPrice(),
            'currency' => $checkoutForm->getCurrency(),
            'charge_id' => $checkoutForm->getPaymentId(),
            'payment_channel' => IYZIPAY_PAYMENT_METHOD_NAME,
            'status' => PaymentStatusEnum::COMPLETED,
            'customer_id' => $request->input('customer_id'),
            'customer_type' => $request->input('customer_type'),
            'payment_type' => 'direct',
            'order_id' => (array)$request->input('order_ids'),
        ], $request);

        return $response
            ->setNextUrl(PaymentHelper::getRedirectURL($request->input('checkout_token')))
            ->setMessage(__('Checkout successfully!'));
    }

    public function getRefund(Request $request, BaseHttpResponse $response)
    {
        $order = app(OrderInterface::class)->findById($request->input('order_id'));

        if ($order) {
            $payment = $order->payment;

            $payment->refunded_amount = $payment->amount;
            $payment->status = PaymentStatusEnum::REFUNDED;
            $payment->refund_note = $request->input('refund_note');
            $payment->save();

            foreach ($order->products as $orderProduct) {
                $product = app(ProductInterface::class)->findById($orderProduct->product_id);

                if ($product && $product->with_storehouse_management) {
                    $product->quantity += $orderProduct->quantity;
                    $product->save();
                }

                $orderProduct = app(OrderProductInterface::class)->getFirstBy([
                    'product_id' => $orderProduct->product_id,
                    'order_id' => $order->id,
                ]);

                if ($orderProduct) {
                    $orderProduct->restock_quantity += $orderProduct->quantity;
                    $orderProduct->save();
                }
            }

            app(OrderHistoryInterface::class)->createOrUpdate([
                'action' => 'refund',
                'description' => trans('plugins/ecommerce::order.refund_success_with_price', [
                    'price' => format_price($payment->amount),
                ]),
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'extras' => json_encode([
                    'amount' => $payment->amount,
                    'method' => $payment->payment_channel,
                ]),
            ]);
        }

        return $response
            ->setNextUrl(route('order.edit', $request->input('order_id')))
            ->setMessage(__('Refund successfully!'));
    }
}
