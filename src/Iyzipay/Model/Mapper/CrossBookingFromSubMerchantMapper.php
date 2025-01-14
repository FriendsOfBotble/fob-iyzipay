<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\CrossBookingFromSubMerchant;

class CrossBookingFromSubMerchantMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new CrossBookingFromSubMerchantMapper($rawResult);
    }

    public function mapCrossBookingFromSubMerchantFrom(CrossBookingFromSubMerchant $booking, $jsonObject)
    {
        parent::mapResourceFrom($booking, $jsonObject);

        return $booking;
    }

    public function mapCrossBookingFromSubMerchant(CrossBookingFromSubMerchant $booking)
    {
        return $this->mapCrossBookingFromSubMerchantFrom($booking, $this->jsonObject);
    }
}
