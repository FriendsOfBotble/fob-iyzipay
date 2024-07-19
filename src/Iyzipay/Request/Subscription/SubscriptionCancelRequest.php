<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionCancelRequest extends Request
{
    private $subscriptionReferenceCode;

    public function setSubscriptionReferenceCode($subscriptionReferenceCode)
    {
        $this->subscriptionReferenceCode = $subscriptionReferenceCode;
    }

    public function getSubscriptionReferenceCode()
    {
        return $this->subscriptionReferenceCode;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('subscriptionReferenceCode', $this->getSubscriptionReferenceCode())
            ->add('locale', $this->getLocale())
            ->add('conversationId', $this->getConversationId())
            ->getObject();
    }
}
