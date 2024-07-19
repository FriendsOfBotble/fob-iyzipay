<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\RefundChargedFromMerchantMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateRefundRequest;

class RefundChargedFromMerchant extends RefundResource
{
    public static function create(CreateRefundRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/refund/merchant/charge', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return RefundChargedFromMerchantMapper::create($rawResult)->jsonDecode()->mapRefundChargedFromMerchant(new RefundChargedFromMerchant());
    }
}
