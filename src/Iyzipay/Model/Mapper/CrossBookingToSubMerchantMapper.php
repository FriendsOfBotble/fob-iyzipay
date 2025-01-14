<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\CrossBookingToSubMerchant;

class CrossBookingToSubMerchantMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new CrossBookingToSubMerchantMapper($rawResult);
    }

    public function mapCrossBookingToSubMerchantFrom(CrossBookingToSubMerchant $booking, $jsonObject)
    {
        parent::mapResourceFrom($booking, $jsonObject);

        return $booking;
    }

    public function mapCrossBookingToSubMerchant(CrossBookingToSubMerchant $booking)
    {
        return $this->mapCrossBookingToSubMerchantFrom($booking, $this->jsonObject);
    }
}
