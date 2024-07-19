<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\SubMerchantPaymentItemMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\SubMerchantPaymentItemUpdateRequest;

class SubMerchantPaymentItemUpdate extends SubMerchantPaymentItemResource
{
    public static function create(SubMerchantPaymentItemUpdateRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->put($options->getBaseUrl() . '/payment/item', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return SubMerchantPaymentItemMapper::create($rawResult)->jsonDecode()->mapSubMerchantPaymentItem(new SubMerchantPaymentItemUpdate());
    }
}
