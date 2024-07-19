<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionDetailsRequest extends Request
{
    private $subscriptionReferenceCode;
    public function getSubscriptionReferenceCode()
    {
        return $this->subscriptionReferenceCode;
    }

    public function setSubscriptionReferenceCode($subscriptionReferenceCode)
    {
        $this->subscriptionReferenceCode = $subscriptionReferenceCode;
    }
    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->getObject();
    }
}
