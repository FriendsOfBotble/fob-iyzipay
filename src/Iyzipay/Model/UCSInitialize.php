<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\UCSInitializeMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\UCSInitializeRequest;

class UCSInitialize extends UCSInitializeResource
{
    public static function create(UCSInitializeRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/ucs/init';
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return UCSInitializeMapper::create($rawResult)->jsonDecode()->mapUCSInitialize(new UCSInitialize());
    }
}
