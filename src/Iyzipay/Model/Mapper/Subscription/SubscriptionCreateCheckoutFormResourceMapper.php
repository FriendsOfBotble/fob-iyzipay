<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription\SubscriptionCreateCheckoutForm;

class SubscriptionCreateCheckoutFormResourceMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SubscriptionCreateCheckoutFormResourceMapper($rawResult);
    }

    public function mapSubscriptionCreateCheckoutFormResourceFrom(SubscriptionCreateCheckoutForm $create, $jsonObject)
    {
        parent::mapResourceFrom($create, $jsonObject);

        if (isset($jsonObject->token)) {
            $create->setToken($jsonObject->token);
        }
        if (isset($jsonObject->checkoutFormContent)) {
            $create->setCheckoutFormContent($jsonObject->checkoutFormContent);
        }
        if (isset($jsonObject->tokenExpireTime)) {
            $create->setTokenExpireTime($jsonObject->tokenExpireTime);
        }

        return $create;
    }

    public function mapSubscriptionCreateCheckoutForm(SubscriptionCreateCheckoutForm $subscriptionCreateCheckoutForm)
    {
        return $this->mapSubscriptionCreateCheckoutFormResourceFrom($subscriptionCreateCheckoutForm, $this->jsonObject);
    }
}
