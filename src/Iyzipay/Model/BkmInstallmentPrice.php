<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\BaseModel;
use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class BkmInstallmentPrice extends BaseModel
{
    private $installmentNumber;
    private $totalPrice;

    public function getInstallmentNumber()
    {
        return $this->installmentNumber;
    }

    public function setInstallmentNumber($installmentNumber)
    {
        $this->installmentNumber = $installmentNumber;
    }

    public function getTotalPrice()
    {
        return $this->totalPrice;
    }

    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    public function getJsonObject()
    {
        return JsonBuilder::create()
            ->add('installmentNumber', $this->getInstallmentNumber())
            ->addPrice('totalPrice', $this->getTotalPrice())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return RequestStringBuilder::create()
            ->append('installmentNumber', $this->getInstallmentNumber())
            ->appendPrice('totalPrice', $this->getTotalPrice())
            ->getRequestString();
    }
}
