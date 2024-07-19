<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink\IyziLinkSaveProductMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\Iyzilink\IyziLinkSaveProductRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class IyziLinkSaveProduct extends IyziLinkSaveProductResource
{
    public static function create(IyziLinkSaveProductRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/iyzilink/products/' . RequestStringBuilder::requestToStringQuery($request, null);
        $rawResult = parent::httpClient()->post($uri, parent::getHttpHeadersV2($uri, $request, $options), $request->toJsonString());

        return IyziLinkSaveProductMapper::create($rawResult)->jsonDecode()->mapIyziLinkSaveProduct(new IyziLinkSaveProduct());
    }
}
