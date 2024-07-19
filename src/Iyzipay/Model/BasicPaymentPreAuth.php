<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\BasicPaymentPreAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateBasicPaymentRequest;

class BasicPaymentPreAuth extends BasicPaymentResource
{
    public static function create(CreateBasicPaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/preauth/basic', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return BasicPaymentPreAuthMapper::create($rawResult)->jsonDecode()->mapBasicPaymentPreAuth(new BasicPaymentPreAuth());
    }
}
