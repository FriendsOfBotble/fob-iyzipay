<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Apm;

class ApmMapper extends ApmResourceMapper
{
    public static function create($rawResult = null)
    {
        return new ApmMapper($rawResult);
    }

    public function mapApmFrom(Apm $apm, $jsonObject)
    {
        parent::mapApmResourceFrom($apm, $jsonObject);

        return $apm;
    }

    public function mapApm(Apm $apm)
    {
        return $this->mapApmFrom($apm, $this->jsonObject);
    }
}
