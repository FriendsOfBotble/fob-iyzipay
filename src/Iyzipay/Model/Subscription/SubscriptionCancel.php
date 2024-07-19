<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription\SubscriptionActionMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription\SubscriptionCancelRequest;

class SubscriptionCancel extends IyzipayResource
{
    public static function cancel(SubscriptionCancelRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/subscription/subscriptions/' . $request->getSubscriptionReferenceCode() . '/cancel';
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return SubscriptionActionMapper::create($rawResult)->jsonDecode()->mapSubscriptionAction(new SubscriptionCancel());
    }
}
