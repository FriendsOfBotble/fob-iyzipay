<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink\IyziLinkRetrieveProductMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class IyziLinkRetrieveProduct extends IyziLinkRetrieveProductResource
{
    public static function create(Request $request, Options $options, $token)
    {
        $uri = $options->getBaseUrl() . '/v2/iyzilink/products/' . $token . RequestStringBuilder::requestToStringQuery($request, null);
        $rawResult = parent::httpClient()->getV2($uri, parent::getHttpHeadersV2($uri, null, $options));

        return IyziLinkRetrieveProductMapper::create($rawResult)->jsonDecode()->mapIyziLinkRetriveProduct(new IyziLinkRetrieveProduct());
    }
}
