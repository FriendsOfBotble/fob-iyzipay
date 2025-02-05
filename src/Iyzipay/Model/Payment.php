<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PaymentMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePaymentRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrievePaymentRequest;

class Payment extends PaymentResource
{
    public static function create(CreatePaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/auth', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PaymentMapper::create($rawResult)->jsonDecode()->mapPayment(new Payment());
    }

    public static function retrieve(RetrievePaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/detail', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PaymentMapper::create($rawResult)->jsonDecode()->mapPayment(new Payment());
    }

    public static function retrieveRawContent(RetrievePaymentRequest $request, Options $options)
    {
        return parent::httpClient()->post($options->getBaseUrl() . '/payment/detail', parent::getHttpHeaders($request, $options), $request->toJsonString());
    }
}
