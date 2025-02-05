<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasicPayment;

class BasicPaymentMapper extends BasicPaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new BasicPaymentMapper($rawResult);
    }

    public function mapBasicPaymentFrom(BasicPayment $payment, $jsonObject)
    {
        parent::mapBasicPaymentResourceFrom($payment, $jsonObject);

        return $payment;
    }

    public function mapBasicPayment(BasicPayment $payment)
    {
        return $this->mapBasicPaymentFrom($payment, $this->jsonObject);
    }
}
