<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PaymentPreAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePaymentRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrievePaymentRequest;

class PaymentPreAuth extends PaymentResource
{
    public static function create(CreatePaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/preauth', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PaymentPreAuthMapper::create($rawResult)->jsonDecode()->mapPaymentPreAuth(new PaymentPreAuth());
    }

    public static function retrieve(RetrievePaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/detail', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PaymentPreAuthMapper::create($rawResult)->jsonDecode()->mapPaymentPreAuth(new PaymentPreAuth());
    }
}
