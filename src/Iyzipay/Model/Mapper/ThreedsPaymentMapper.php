<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\ThreedsPayment;

class ThreedsPaymentMapper extends PaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new ThreedsPaymentMapper($rawResult);
    }

    public function mapThreedsPaymentFrom(ThreedsPayment $auth, $jsonObject)
    {
        parent::mapPaymentResourceFrom($auth, $jsonObject);

        return $auth;
    }

    public function mapThreedsPayment(ThreedsPayment $auth)
    {
        return $this->mapThreedsPaymentFrom($auth, $this->jsonObject);
    }
}
