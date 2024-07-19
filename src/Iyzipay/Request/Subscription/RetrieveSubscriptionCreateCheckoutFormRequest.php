<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class RetrieveSubscriptionCreateCheckoutFormRequest extends Request
{
    private $checkoutFormToken;

    public function getCheckoutFormToken()
    {
        return $this->checkoutFormToken;
    }

    public function setCheckoutFormToken($checkoutFormToken)
    {
        $this->checkoutFormToken = $checkoutFormToken;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->getObject();
    }
}
