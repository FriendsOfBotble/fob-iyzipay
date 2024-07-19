<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class RetrievePaymentRequest extends Request
{
    private $paymentId;
    private $paymentConversationId;

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

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
            ->add('paymentId', $this->getPaymentId())
            ->add('paymentConversationId', $this->getPaymentConversationId())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return RequestStringBuilder::create()
            ->appendSuper(parent::toPKIRequestString())
            ->append('paymentId', $this->getPaymentId())
            ->append('paymentConversationId', $this->getPaymentConversationId())
            ->getRequestString();
    }
}
