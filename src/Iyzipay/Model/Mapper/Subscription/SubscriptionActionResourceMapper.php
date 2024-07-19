<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\IyzipayResourceMapper;

class SubscriptionActionResourceMapper extends IyzipayResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SubscriptionActionResourceMapper($rawResult);
    }

    public function mapSubscriptionActionResourceFrom(IyzipayResource $create, $jsonObject)
    {
        parent::mapResourceFrom($create, $jsonObject);

        return $create;
    }
    public function mapSubscriptionAction($create)
    {
        return $this->mapSubscriptionActionResourceFrom($create, $this->jsonObject);
    }
}
