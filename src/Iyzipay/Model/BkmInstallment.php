<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\BaseModel;
use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class BkmInstallment extends BaseModel
{
    private $bankId;
    private $installmentPrices;

    public function getBankId()
    {
        return $this->bankId;
    }

    public function setBankId($bankId)
    {
        $this->bankId = $bankId;
    }

    public function getInstallmentPrices()
    {
        return $this->installmentPrices;
    }

    public function setInstallmentPrices($installmentPrices)
    {
        $this->installmentPrices = $installmentPrices;
    }

    public function getJsonObject()
    {
        return JsonBuilder::create()
            ->add('bankId', $this->getBankId())
            ->addArray('installmentPrices', $this->getInstallmentPrices())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return RequestStringBuilder::create()
            ->append('bankId', $this->getBankId())
            ->appendArray('installmentPrices', $this->getInstallmentPrices())
            ->getRequestString();
    }
}
