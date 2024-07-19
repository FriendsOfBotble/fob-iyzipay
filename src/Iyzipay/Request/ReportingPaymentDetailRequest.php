<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class ReportingPaymentDetailRequest extends Request
{
    private $paymentConversationId;

    public function getPaymentConversationId()
    {
        return $this->paymentConversationId;
    }

    public function setPaymentConversationId($paymentConversationId)
    {
        $this->paymentConversationId = $paymentConversationId;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('paymentConversationId', $this->getPaymentConversationId())
            ->getObject();
    }
}
