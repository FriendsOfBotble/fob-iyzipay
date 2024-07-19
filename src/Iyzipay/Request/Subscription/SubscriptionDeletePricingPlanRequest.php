<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class SubscriptionDeletePricingPlanRequest extends Request
{
    private $pricingPlanReferenceCode;

    public function getPricingPlanReferenceCode()
    {
        return $this->pricingPlanReferenceCode;
    }

    public function setPricingPlanReferenceCode($pricingPlanReferenceCode)
    {
        $this->pricingPlanReferenceCode= $pricingPlanReferenceCode;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('locale', $this->getLocale())
            ->add('conversationId', $this->getConversationId())
            ->add('pricingPlanReferenceCode', $this->getPricingPlanReferenceCode())
            ->getObject();
    }
}
