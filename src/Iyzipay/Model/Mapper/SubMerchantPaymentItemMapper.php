<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\SubMerchantPaymentItemUpdate;

class SubMerchantPaymentItemMapper extends SubMerchantPaymentItemResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SubMerchantPaymentItemMapper($rawResult);
    }

    public function mapSubMerchantPaymentItemFrom(SubMerchantPaymentItemUpdate $create, $jsonObject)
    {
        parent::mapSubMerchantPaymentItemResourceFrom($create, $jsonObject);

        return $create;
    }

    public function mapSubMerchantPaymentItem(SubMerchantPaymentItemUpdate $create)
    {
        return $this->mapSubMerchantPaymentItemFrom($create, $this->jsonObject);
    }
}
