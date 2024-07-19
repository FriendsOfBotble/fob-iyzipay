<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PaymentPostAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePaymentPostAuthRequest;

class PaymentPostAuth extends PaymentResource
{
    public static function create(CreatePaymentPostAuthRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/postauth', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PaymentPostAuthMapper::create($rawResult)->jsonDecode()->mapPaymentPostAuth(new PaymentPostAuth());
    }
}
