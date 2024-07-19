<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription\SubscriptionCardUpdateMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription\SubscriptionCardUpdateRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription\SubscriptionCardUpdateWithSubscriptionReferenceCodeRequest;

class SubscriptionCardUpdate extends IyzipayResource
{
    private $token;
    private $checkoutFormContent;
    private $tokenExpireTime;

    public static function update(SubscriptionCardUpdateRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/subscription/card-update/checkoutform/initialize';
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return SubscriptionCardUpdateMapper::create($rawResult)->jsonDecode()->mapSubscriptionCardUpdate(new SubscriptionCardUpdate());
    }

    public static function updateWithSubscriptionReferenceCode(SubscriptionCardUpdateWithSubscriptionReferenceCodeRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/subscription/card-update/checkoutform/initialize/with-subscription';
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return SubscriptionCardUpdateMapper::create($rawResult)->jsonDecode()->mapSubscriptionCardUpdate(new SubscriptionCardUpdate());
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getCheckoutFormContent()
    {
        return $this->checkoutFormContent;
    }

    public function setCheckoutFormContent($checkoutFormContent)
    {
        $this->checkoutFormContent = $checkoutFormContent;
    }

    public function getTokenExpireTime()
    {
        return $this->tokenExpireTime;
    }

    public function setTokenExpireTime($tokenExpireTime)
    {
        $this->tokenExpireTime = $tokenExpireTime;
    }
}
