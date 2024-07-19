<?php

namespace FriendsOfBotble\Iyzipay\Services;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\RefundToBalance;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateRefundToBalanceRequest;

class Iyzipay
{
    public function getCredentials(): Options
    {
        $options = new Options();
        $options->setApiKey(get_payment_setting('api_key', IYZIPAY_PAYMENT_METHOD_NAME));
        $options->setSecretKey(get_payment_setting('secret', IYZIPAY_PAYMENT_METHOD_NAME));
        $options->setBaseUrl(setting('payment_' . IYZIPAY_PAYMENT_METHOD_NAME . '_mode') == 0 ? 'https://sandbox-api.iyzipay.com' : 'https://api.iyzipay.com');

        return $options;
    }

    public function refundOrder($paymentId, array $optionRefunds): RefundToBalance
    {
        $request = new CreateRefundToBalanceRequest();
        $request->setPaymentId($paymentId);
        $request->setCallbackUrl(route('iyzipay.payment.refund', $optionRefunds));
        $request->setLocale(app()->getLocale());

        return RefundToBalance::create($request, (new Iyzipay())->getCredentials());
    }
}
