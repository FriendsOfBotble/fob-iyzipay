<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription\SubscriptionActionMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription\SubscriptionRetryRequest;

class SubscriptionRetry extends IyzipayResource
{
    public static function update(SubscriptionRetryRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/subscription/operation/retry';
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return SubscriptionActionMapper::create($rawResult)->jsonDecode()->mapSubscriptionAction(new SubscriptionRetry());
    }
}
