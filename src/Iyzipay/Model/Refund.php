<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\RefundMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateRefundRequest;

class Refund extends RefundResource
{
    public static function create(CreateRefundRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/refund', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return RefundMapper::create($rawResult)->jsonDecode()->mapRefund(new Refund());
    }
}
