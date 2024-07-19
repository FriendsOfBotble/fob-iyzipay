<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CrossBookingToSubMerchantMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCrossBookingRequest;

class CrossBookingToSubMerchant extends IyzipayResource
{
    public static function create(CreateCrossBookingRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/crossbooking/send', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CrossBookingToSubMerchantMapper::create($rawResult)->jsonDecode()->mapCrossBookingToSubMerchant(new CrossBookingToSubMerchant());
    }
}
