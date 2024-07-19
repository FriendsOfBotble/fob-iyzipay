<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\RefundToBalanceMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateRefundToBalanceRequest;

class RefundToBalance extends RefundToBalanceResource
{
    public static function create(CreateRefundToBalanceRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/refund-to-balance/init', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return RefundToBalanceMapper::create($rawResult)->jsonDecode()->mapRefundToBalance(new RefundToBalance());
    }
}
