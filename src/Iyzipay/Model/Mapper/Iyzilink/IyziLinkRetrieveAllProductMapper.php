<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink\IyziLinkRetrieveAllProduct;

class IyziLinkRetrieveAllProductMapper extends IyziLinkRetrieveAllProductResourceMapper
{
    public static function create($rawResult = null)
    {
        return new IyziLinkRetrieveAllProductMapper($rawResult);
    }

    public function mapIyziLinkRetriveAllProductFrom(IyziLinkRetrieveAllProduct $create, $jsonObject)
    {
        parent::mapIyziLinkRetriveAllProductResourceFrom($create, $jsonObject);

        return $create;
    }

    public function mapIyziLinkRetriveAllProduct(IyziLinkRetrieveAllProduct $create)
    {
        return $this->mapIyziLinkRetriveAllProductFrom($create, $this->jsonObject);
    }
}
