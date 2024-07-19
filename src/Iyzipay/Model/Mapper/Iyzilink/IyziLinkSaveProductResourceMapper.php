<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Iyzilink;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Iyzilink\IyziLinkSaveProductResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;

class IyziLinkSaveProductResourceMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new IyzipayResourceMapper($rawResult);
    }

    public function mapIyziLinkSaveProductResourceFrom(IyziLinkSaveProductResource $create, $jsonObject)
    {
        parent::mapResourceFrom($create, $jsonObject);

        if (isset($jsonObject->data->token)) {
            $create->setToken($jsonObject->data->token);
        }
        if (isset($jsonObject->data->url)) {
            $create->setUrl($jsonObject->data->url);
        }
        if (isset($jsonObject->data->imageUrl)) {
            $create->setImageUrl($jsonObject->data->imageUrl);
        }

        return $create;
    }
}
