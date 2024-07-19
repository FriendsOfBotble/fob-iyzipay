<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class RetrieveSubMerchantRequest extends Request
{
    private $subMerchantExternalId;

    public function getSubMerchantExternalId()
    {
        return $this->subMerchantExternalId;
    }

    public function setSubMerchantExternalId($subMerchantExternalId)
    {
        $this->subMerchantExternalId = $subMerchantExternalId;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('subMerchantExternalId', $this->getSubMerchantExternalId())
            ->getObject();
    }

    public function toPKIRequestString()
    {
        return RequestStringBuilder::create()
            ->appendSuper(parent::toPKIRequestString())
            ->append('subMerchantExternalId', $this->getSubMerchantExternalId())
            ->getRequestString();
    }
}
