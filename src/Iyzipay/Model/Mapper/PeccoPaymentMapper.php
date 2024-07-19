<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\PeccoPayment;

class PeccoPaymentMapper extends PaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new PeccoPaymentMapper($rawResult);
    }

    public function mapPeccoPaymentFrom(PeccoPayment $payment, $jsonObject)
    {
        parent::mapPaymentResourceFrom($payment, $jsonObject);

        if (isset($jsonObject->token)) {
            $payment->setToken($jsonObject->token);
        }

        return $payment;
    }

    public function mapPeccoPayment(PeccoPayment $auth)
    {
        return $this->mapPeccoPaymentFrom($auth, $this->jsonObject);
    }
}
