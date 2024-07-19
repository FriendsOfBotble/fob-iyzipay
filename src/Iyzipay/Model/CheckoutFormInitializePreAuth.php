<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CheckoutFormInitializePreAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCheckoutFormInitializeRequest;

class CheckoutFormInitializePreAuth extends CheckoutFormInitializeResource
{
    public static function create(CreateCheckoutFormInitializeRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/checkoutform/initialize/preauth/ecom', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CheckoutFormInitializePreAuthMapper::create($rawResult)->jsonDecode()->mapCheckoutFormInitializePreAuth(new CheckoutFormInitializePreAuth());
    }
}
