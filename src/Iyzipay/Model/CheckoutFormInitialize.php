<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CheckoutFormInitializeMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCheckoutFormInitializeRequest;

class CheckoutFormInitialize extends CheckoutFormInitializeResource
{
    public static function create(CreateCheckoutFormInitializeRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/checkoutform/initialize/auth/ecom', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CheckoutFormInitializeMapper::create($rawResult)->jsonDecode()->mapCheckoutFormInitialize(new CheckoutFormInitialize());
    }
}
