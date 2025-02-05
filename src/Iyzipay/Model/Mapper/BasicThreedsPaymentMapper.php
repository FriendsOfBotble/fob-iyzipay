<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasicThreedsPayment;

class BasicThreedsPaymentMapper extends BasicPaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new BasicThreedsPaymentMapper($rawResult);
    }

    public function mapBasicThreedsPaymentFrom(BasicThreedsPayment $auth, $jsonObject)
    {
        parent::mapBasicPaymentResourceFrom($auth, $jsonObject);

        return $auth;
    }

    public function mapBasicThreedsPayment(BasicThreedsPayment $auth)
    {
        return $this->mapBasicThreedsPaymentFrom($auth, $this->jsonObject);
    }
}
