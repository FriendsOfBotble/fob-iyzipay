<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Refund;

class RefundMapper extends RefundResourceMapper
{
    public static function create($rawResult = null)
    {
        return new RefundMapper($rawResult);
    }

    public function mapRefundFrom(Refund $refund, $jsonObject)
    {
        parent::mapRefundResourceFrom($refund, $jsonObject);

        return $refund;
    }

    public function mapRefund(Refund $refund)
    {
        return $this->mapRefundFrom($refund, $this->jsonObject);
    }
}
