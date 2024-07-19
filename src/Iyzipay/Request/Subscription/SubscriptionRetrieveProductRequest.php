<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionRetrieveProductRequest extends Request
{
    private $productReferenceCode;

    public function getProductReferenceCode()
    {
        return $this->productReferenceCode;
    }

    public function setProductReferenceCode($productReferenceCode)
    {
        $this->productReferenceCode = $productReferenceCode;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->getObject();
    }
}
