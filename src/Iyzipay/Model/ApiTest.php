<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;

class ApiTest extends IyzipayResource
{
    public static function retrieve(Options $options)
    {
        $rawResult = parent::httpClient()->get($options->getBaseUrl() . '/payment/test');

        return IyzipayResourceMapper::create($rawResult)->jsonDecode()->mapResource(new IyzipayResource());
    }
}
