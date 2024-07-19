<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionRetrieveCustomerRequest extends Request
{
    private $customerReferenceCode;

    public function getCustomerReferenceCode()
    {
        return $this->customerReferenceCode;
    }

    public function setCustomerReferenceCode($customerReferenceCode)
    {
        $this->customerReferenceCode = $customerReferenceCode;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->getObject();
    }
}
