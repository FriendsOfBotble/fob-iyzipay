<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink\IyziLinkRetrieveAllProductMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\PagininRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class IyziLinkRetrieveAllProduct extends IyziLinkRetrieveAllProductResource
{
    public static function create(PagininRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/iyzilink/products' . RequestStringBuilder::requestToStringQuery($request, 'pages');
        $rawResult = parent::httpClient()->getV2($uri, parent::getHttpHeadersV2($uri, null, $options));

        return IyziLinkRetrieveAllProductMapper::create($rawResult)->jsonDecode()->mapIyziLinkRetriveAllProduct(new IyziLinkRetrieveAllProduct());
    }
}
