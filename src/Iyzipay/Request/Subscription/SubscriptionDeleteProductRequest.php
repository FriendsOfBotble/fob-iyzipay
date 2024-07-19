<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionDeleteProductRequest extends Request
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
            ->add('locale', $this->getLocale())
            ->add('conversationId', $this->getConversationId())
            ->add('productReferenceCode', $this->getProductReferenceCode())
            ->getObject();
    }
}
