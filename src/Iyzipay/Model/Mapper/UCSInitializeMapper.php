<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\UCSInitialize;

class UCSInitializeMapper extends UCSInitializeResourceMapper
{
    public static function create($rawResult = null)
    {
        return new UCSInitializeMapper($rawResult);
    }

    public function mapUCSInitializeFrom(UCSInitialize $initialize, $jsonObject)
    {
        parent::mapUCSInitializeResourceFrom($initialize, $jsonObject);

        return $initialize;
    }

    public function mapUCSInitialize(UCSInitialize $initialize)
    {
        return $this->mapUCSInitializeFrom($initialize, $this->jsonObject);
    }
}
