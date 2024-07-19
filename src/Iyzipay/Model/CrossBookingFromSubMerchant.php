<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CrossBookingFromSubMerchantMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCrossBookingRequest;

class CrossBookingFromSubMerchant extends IyzipayResource
{
    public static function create(CreateCrossBookingRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/crossbooking/receive', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CrossBookingFromSubMerchantMapper::create($rawResult)->jsonDecode()->mapCrossBookingFromSubMerchant(new CrossBookingFromSubMerchant());
    }
}
