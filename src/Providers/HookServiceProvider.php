<?php

namespace FriendsOfBotble\Iyzipay\Providers;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Address;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasketItem;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasketItemType;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Buyer;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\CheckoutFormInitialize;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\PaymentGroup;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\PayWithIyzicoInitialize;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePayWithIyzicoInitializeRequest;
use FriendsOfBotble\Iyzipay\Services\Gateways\IyzipayPaymentService;
use FriendsOfBotble\Iyzipay\Services\Iyzipay;
use Botble\Ecommerce\Models\Currency;
use Botble\Ecommerce\Repositories\Interfaces\OrderInterface;
use Botble\Payment\Enums\PaymentMethodEnum;
use Exception;
use Html;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_filter(PAYMENT_FILTER_ADDITIONAL_PAYMENT_METHODS, [$this, 'registerIyzipayMethod'], 16, 2);
        $this->app->booted(function () {
            add_filter(PAYMENT_FILTER_AFTER_POST_CHECKOUT, [$this, 'checkoutWithIyzipay'], 16, 2);
        });

        add_filter(PAYMENT_METHODS_SETTINGS_PAGE, [$this, 'addPaymentSettings'], 97);

        add_filter(BASE_FILTER_ENUM_ARRAY, function ($values, $class) {
            if ($class == PaymentMethodEnum::class) {
                $values['IYZIPAY'] = IYZIPAY_PAYMENT_METHOD_NAME;
            }

            return $values;
        }, 28, 2);

        add_filter(BASE_FILTER_ENUM_LABEL, function ($value, $class) {
            if ($class == PaymentMethodEnum::class && $value == IYZIPAY_PAYMENT_METHOD_NAME) {
                $value = 'Iyzipay';
            }

            return $value;
        }, 28, 2);

        add_filter(BASE_FILTER_ENUM_HTML, function ($value, $class) {
            if ($class == PaymentMethodEnum::class && $value == IYZIPAY_PAYMENT_METHOD_NAME) {
                $value = Html::tag(
                    'span',
                    PaymentMethodEnum::getLabel($value),
                    ['class' => 'label-success status-label']
                )
                    ->toHtml();
            }

            return $value;
        }, 28, 2);

        add_filter(PAYMENT_FILTER_GET_SERVICE_CLASS, function ($data, $value) {
            if ($value == IYZIPAY_PAYMENT_METHOD_NAME) {
                $data = IyzipayPaymentService::class;
            }

            return $data;
        }, 20, 2);

        add_filter(PAYMENT_FILTER_PAYMENT_INFO_DETAIL, function ($data, $payment) {
            if ($payment->payment_channel == IYZIPAY_PAYMENT_METHOD_NAME) {
                $paymentService = (new IyzipayPaymentService());
                $paymentDetail = $paymentService->getPaymentDetails($payment);
                if ($paymentDetail) {
                    $data = view(
                        'plugins/iyzipay::detail',
                        ['payment' => $paymentDetail, 'paymentModel' => $payment]
                    )->render();
                }
            }

            return $data;
        }, 20, 2);

        add_filter(PAYMENT_FILTER_GET_REFUND_DETAIL, function ($data, $payment, $refundId) {
            if ($payment->payment_channel == IYZIPAY_PAYMENT_METHOD_NAME) {
                $refundDetail = (new IyzipayPaymentService())->getRefundDetails($refundId);
                if (! Arr::get($refundDetail, 'error')) {
                    $refunds = Arr::get($payment->metadata, 'refunds');
                    $refund = collect($refunds)->firstWhere('data.id', $refundId);
                    $refund = array_merge($refund, Arr::get($refundDetail, 'data', []));

                    return array_merge($refundDetail, [
                        'view' => view(
                            'plugins/iyzipay::refund-detail',
                            ['refund' => $refund, 'paymentModel' => $payment]
                        )->render(),
                    ]);
                }

                return $refundDetail;
            }

            return $data;
        }, 20, 3);
    }

    public function addPaymentSettings($settings): string
    {
        return $settings . view('plugins/iyzipay::settings')->render();
    }

    public function registerIyzipayMethod($html, array $data): string
    {
        return $html . view('plugins/iyzipay::methods', $data)->render();
    }

    public function checkoutWithIyzipay(array $data, Request $request)
    {
        if ($data['type'] !== IYZIPAY_PAYMENT_METHOD_NAME) {
            return $data;
        }

        $currentCurrency = get_application_currency();

        $paymentData = apply_filters(PAYMENT_FILTER_PAYMENT_DATA, [], $request);

        if (strtoupper($currentCurrency->title) !== 'TRY') {
            $supportedCurrency = Currency::query()->where('title', 'TRY')->first();

            if ($supportedCurrency) {
                $paymentData['currency'] = strtoupper($supportedCurrency->title);
                if ($currentCurrency->is_default) {
                    $paymentData['amount'] = $paymentData['amount'] * $supportedCurrency->exchange_rate;
                } else {
                    $paymentData['amount'] = format_price(
                        $paymentData['amount'] / $currentCurrency->exchange_rate,
                        $currentCurrency,
                        true
                    );
                }
            }
        }

        $supportedCurrencies = (new IyzipayPaymentService())->supportedCurrencyCodes();

        if (! in_array($paymentData['currency'], $supportedCurrencies)) {
            $data['error'] = true;
            $data['message'] = __(
                ":name doesn't support :currency. List of currencies supported by :name: :currencies.",
                [
                    'name' => 'Iyzipay',
                    'currency' => $paymentData['currency'],
                    'currencies' => implode(', ', $supportedCurrencies),
                ]
            );

            return $data;
        }

        $orderIds = $paymentData['order_id'];

        $paymentType = get_payment_setting('payment_type', IYZIPAY_PAYMENT_METHOD_NAME, 'CheckoutForm');

        try {
            if ($paymentType == 'PayWithIyzico') {
                $paymentRequest = new CreatePayWithIyzicoInitializeRequest();
            } else {
                $paymentRequest = new CreateCheckoutFormInitializeRequest();
            }

            $paymentRequest->setLocale($this->app->getLocale());
            $paymentRequest->setCurrency($paymentData['currency']);
            $paymentRequest->setPaymentGroup(PaymentGroup::PRODUCT);
            $paymentRequest->setEnabledInstallments([2, 3, 6, 9]);
            $paymentRequest->setCallbackUrl(
                route('iyzipay.payment.callback', [
                    'checkout_token' => $paymentData['checkout_token'],
                    'order_ids' => $orderIds,
                    'customer_id' => $paymentData['customer_id'],
                    'customer_type' => $paymentData['customer_type'],
                ])
            );

            $buyer = new Buyer();
            $buyer->setId($paymentData['customer_id'] ?: time() . Str::random(10));

            $buyer->setName(Str::of($paymentData['address']['name'])->before(' ')->toString());
            $buyer->setSurname(Str::of($paymentData['address']['name'])->after(' ')->toString());
            $buyer->setIdentityNumber(Str::random(5));
            $buyer->setEmail($paymentData['address']['email']);
            $buyer->setRegistrationAddress($paymentData['address']['address']);
            $buyer->setCity($paymentData['address']['city']);
            $buyer->setCountry($paymentData['address']['country']);
            $buyer->setZipCode($paymentData['address']['zip_code']);

            $shippingAddress = new Address();
            $shippingAddress->setContactName($paymentData['address']['name']);
            $shippingAddress->setCity($paymentData['address']['city']);
            $shippingAddress->setCountry($paymentData['address']['country']);
            $shippingAddress->setAddress($paymentData['address']['address']);
            $shippingAddress->setZipCode($paymentData['address']['zip_code']);
            $paymentRequest->setShippingAddress($shippingAddress);
            $paymentRequest->setBillingAddress($shippingAddress);

            $buyer->setIp($request->ip());
            $paymentRequest->setBuyer($buyer);

            $orders = $this->app->make(OrderInterface::class)->advancedGet([
                'condition' => [
                    ['id', 'IN', $orderIds],
                    'is_finished' => false,
                ],
            ]);

            $subTotal = 0;
            $basketItems = [];

            foreach ($orders as $order) {
                foreach ($order->products as $product) {
                    $basketItem = new BasketItem();
                    $basketItem->setId($product->product_id);
                    $basketItem->setName($product->product_name);

                    if (count($product->product->categories) > 1) {
                        $basketItem->setCategory1($product->product->categories[0]->name);
                    } else {
                        $basketItem->setCategory1('-');
                    }

                    if (count($product->product->categories) > 2) {
                        $basketItem->setCategory2($product->product->categories[1]->name);
                    }

                    $basketItem->setItemType(BasketItemType::PHYSICAL);
                    $basketItem->setPrice($product->price * $product->qty * get_current_exchange_rate());

                    $subTotal += $basketItem->getPrice();

                    $basketItems[] = $basketItem;
                }
            }

            $paymentRequest->setPrice($subTotal);
            $paymentRequest->setPaidPrice($paymentData['amount']);

            $paymentRequest->setBasketItems($basketItems);

            $credentials = (new Iyzipay())->getCredentials();

            if ($paymentType == 'PayWithIyzico') {
                $payWithIyzicoInitialize = PayWithIyzicoInitialize::create($paymentRequest, $credentials);
            } else {
                $payWithIyzicoInitialize = CheckoutFormInitialize::create($paymentRequest, $credentials);
            }

            if ($payWithIyzicoInitialize->getStatus() == 'success') {
                if ($paymentType == 'PayWithIyzico') {
                    header('Location: ' . $payWithIyzicoInitialize->getPayWithIyzicoPageUrl());
                } else {
                    header('Location: ' . $payWithIyzicoInitialize->getPaymentPageUrl());
                }

                exit;
            }

            $data['error'] = true;
            $data['message'] = $payWithIyzicoInitialize->getErrorMessage();
        } catch (Exception $exception) {
            $data['error'] = true;
            $data['message'] = json_encode($exception->getMessage());
        }

        return $data;
    }
}
