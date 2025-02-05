<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\RefundToBalance;

class RefundToBalanceMapper extends RefundToBalanceResourceMapper
{
    public static function create($rawResult = null)
    {
        return new RefundToBalanceMapper($rawResult);
    }

    public function mapRefundToBalanceFrom(RefundToBalance $refundToBalance, $jsonObject)
    {
        parent::mapRefundToBalanceResourceFrom($refundToBalance, $jsonObject);

        return $refundToBalance;
    }

    public function mapRefundToBalance(RefundToBalance $refundToBalance)
    {
        return $this->mapRefundToBalanceFrom($refundToBalance, $this->jsonObject);
    }
}
