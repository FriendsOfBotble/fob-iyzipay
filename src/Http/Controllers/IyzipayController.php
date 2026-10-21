<?php

namespace FriendsOfBotble\Iyzipay\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Ecommerce\Repositories\Interfaces\OrderHistoryInterface;
use Botble\Ecommerce\Repositories\Interfaces\OrderInterface;
use Botble\Ecommerce\Repositories\Interfaces\OrderProductInterface;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Hotel\Models\Booking;
use Botble\Payment\Enums\PaymentStatusEnum;
use Botble\Payment\Models\Payment;
use Botble\Payment\Supports\PaymentHelper;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\CheckoutForm;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Locale;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveCheckoutFormRequest;
use FriendsOfBotble\Iyzipay\Services\Iyzipay;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class IyzipayController extends BaseController
{
    public function getCallback(Request $request, BaseHttpResponse $response, Iyzipay $iyzipay)
    {
        $paymentRequest = new RetrieveCheckoutFormRequest();
        $paymentRequest->setLocale(Locale::EN);
        $paymentRequest->setToken($request->input('token'));

        $checkoutForm = CheckoutForm::retrieve($paymentRequest, $iyzipay->getCredentials());

        if ($checkoutForm->getStatus() !== 'success' || $checkoutForm->getPaymentStatus() !== 'SUCCESS') {
            return $response
                ->setError()
                ->setNextUrl(PaymentHelper::getCancelURL())
                ->setMessage($checkoutForm->getErrorMessage() ?: __('Checkout failed!'));
        }

        $orderId = array_values(array_filter((array) $request->input('order_ids')));

        if (! $orderId || $checkoutForm->getBasketId() !== implode('-', $orderId)) {
            return $response
                ->setError()
                ->setNextUrl(PaymentHelper::getCancelURL())
                ->setMessage(__('Checkout failed!'));
        }

        // A reloaded or replayed callback carries the same token, so only process the payment once.
        $alreadyProcessed = Payment::query()
            ->where('charge_id', $checkoutForm->getPaymentId())
            ->where('status', PaymentStatusEnum::COMPLETED)
            ->exists();

        if (! $alreadyProcessed) {
            do_action(PAYMENT_ACTION_PAYMENT_PROCESSED, [
                'amount' => $checkoutForm->getPaidPrice(),
                'currency' => $checkoutForm->getCurrency(),
                'charge_id' => $checkoutForm->getPaymentId(),
                'payment_channel' => IYZIPAY_PAYMENT_METHOD_NAME,
                'status' => PaymentStatusEnum::COMPLETED,
                'customer_id' => $request->input('customer_id'),
                'customer_type' => $request->input('customer_type'),
                'payment_type' => 'direct',
                'order_id' => $orderId,
            ], $request);
        }

        if (is_plugin_active('hotel')) {
            $booking = Booking::query()
                ->select('transaction_id')
                ->find(Arr::first($orderId));

            if (! $booking) {
                return $response
                    ->setNextUrl(PaymentHelper::getCancelURL())
                    ->setMessage(__('Checkout failed!'));
            }

            return $response
                ->setNextUrl(PaymentHelper::getRedirectURL($booking->transaction_id))
                ->setMessage(__('Checkout successfully!'));
        }

        $nextUrl = PaymentHelper::getRedirectURL($request->input('checkout_token'));

        if (is_plugin_active('job-board') || is_plugin_active('real-estate')) {
            $nextUrl = $nextUrl . '?charge_id=' . $checkoutForm->getPaymentId();
        }

        return $response
            ->setNextUrl($nextUrl)
            ->setMessage(__('Checkout successfully!'));
    }

    public function getRefund(Request $request, BaseHttpResponse $response)
    {
        abort_unless($request->hasValidRelativeSignatureWhileIgnoring(['token']), 403);

        $order = app(OrderInterface::class)->findById($request->query('order_id'));
        $payment = $order?->payment;

        if (
            $payment
            && $payment->payment_channel == IYZIPAY_PAYMENT_METHOD_NAME
            && $payment->status != PaymentStatusEnum::REFUNDED
        ) {
            $payment->refunded_amount = $payment->amount;
            $payment->status = PaymentStatusEnum::REFUNDED;
            $payment->refund_note = $request->query('refund_note');
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
            ->setNextUrl(route('order.edit', $request->query('order_id')))
            ->setMessage(__('Refund successfully!'));
    }
}
