<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\ApmMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateApmInitializeRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveApmRequest;

class Apm extends ApmResource
{
    public static function create(CreateApmInitializeRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/apm/initialize', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return ApmMapper::create($rawResult)->jsonDecode()->mapApm(new Apm());
    }

    public static function retrieve(RetrieveApmRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/apm/retrieve', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return ApmMapper::create($rawResult)->jsonDecode()->mapApm(new Apm());
    }
}
