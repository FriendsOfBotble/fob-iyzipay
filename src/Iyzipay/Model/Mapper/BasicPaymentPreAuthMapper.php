<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasicPaymentPreAuth;

class BasicPaymentPreAuthMapper extends BasicPaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new BasicPaymentPreAuthMapper($rawResult);
    }

    public function mapBasicPaymentPreAuthFrom(BasicPaymentPreAuth $preAuth, $jsonObject)
    {
        parent::mapBasicPaymentResourceFrom($preAuth, $jsonObject);

        return $preAuth;
    }

    public function mapBasicPaymentPreAuth(BasicPaymentPreAuth $preAuth)
    {
        return $this->mapBasicPaymentPreAuthFrom($preAuth, $this->jsonObject);
    }
}
