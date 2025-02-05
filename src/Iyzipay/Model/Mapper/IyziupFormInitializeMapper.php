<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\IyziupFormInitialize;

class IyziupFormInitializeMapper extends IyziupFormInitializeResourceMapper
{
    public static function create($rawResult = null)
    {
        return new IyziupFormInitializeMapper($rawResult);
    }

    public function mapIyziupFormInitializeFrom(IyziupFormInitialize $initialize, $jsonObject)
    {
        parent::mapIyziupFormInitializeResource($initialize, $jsonObject);

        return $initialize;
    }

    public function mapIyziupFormInitialize(IyziupFormInitialize $initialize)
    {
        return $this->mapIyziupFormInitializeFrom($initialize, $this->jsonObject);
    }
}
