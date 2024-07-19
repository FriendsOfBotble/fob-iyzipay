<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyziupFormInitializeMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateIyziupFormInitializeRequest;

class IyziupFormInitialize extends IyziupFormInitializeResource
{
    public static function create(CreateIyziupFormInitializeRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/v1/iyziup/form/initialize', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return IyziupFormInitializeMapper::create($rawResult)->jsonDecode()->mapIyziupFormInitialize(new IyziupFormInitialize());
    }
}
