<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\BasicPaymentPostAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePaymentPostAuthRequest;

class BasicPaymentPostAuth extends BasicPaymentResource
{
    public static function create(CreatePaymentPostAuthRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/postauth/basic', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return BasicPaymentPostAuthMapper::create($rawResult)->jsonDecode()->mapBasicPaymentPostAuth(new BasicPaymentPostAuth());
    }
}
