<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\BasicPaymentMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateBasicPaymentRequest;

class BasicPayment extends BasicPaymentResource
{
    public static function create(CreateBasicPaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/auth/basic', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return BasicPaymentMapper::create($rawResult)->jsonDecode()->mapBasicPayment(new BasicPayment());
    }
}
