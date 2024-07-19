<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink\IyziLinkDeleteProductMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class IyziLinkDeleteProduct extends IyziLinkDeleteProductResource
{
    public static function create(Request $request, Options $options, $token)
    {
        $uri = $options->getBaseUrl() . '/v2/iyzilink/products/' . $token . RequestStringBuilder::requestToStringQuery($request, null);
        $rawResult = parent::httpClient()->delete($uri, parent::getHttpHeadersV2($uri, null, $options));

        return IyziLinkDeleteProductMapper::create($rawResult)->jsonDecode()->mapIyziLinkDeleteProduct(new IyziLinkDeleteProduct());
    }
}
