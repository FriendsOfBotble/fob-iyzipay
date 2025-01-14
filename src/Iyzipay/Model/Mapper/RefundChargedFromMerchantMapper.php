<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\RefundChargedFromMerchant;

class RefundChargedFromMerchantMapper extends RefundResourceMapper
{
    public static function create($rawResult = null)
    {
        return new RefundChargedFromMerchantMapper($rawResult);
    }

    public function mapRefundChargedFromMerchantFrom(RefundChargedFromMerchant $refund, $jsonObject)
    {
        parent::mapRefundResourceFrom($refund, $jsonObject);

        return $refund;
    }

    public function mapRefundChargedFromMerchant(RefundChargedFromMerchant $refund)
    {
        return $this->mapRefundChargedFromMerchantFrom($refund, $this->jsonObject);
    }
}
