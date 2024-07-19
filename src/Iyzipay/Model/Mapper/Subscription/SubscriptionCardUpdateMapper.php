<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\Subscription;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Subscription\SubscriptionCardUpdate;

class SubscriptionCardUpdateMapper extends SubscriptionCardUpdateResourceMapper
{
    public static function create($rawResult = null)
    {
        return new SubscriptionCardUpdateMapper($rawResult);
    }

    public function mapSubscriptionCardUpdateFrom(SubscriptionCardUpdate $create, $jsonObject)
    {
        parent::mapSubscriptionCardUpdateResourceFrom($create, $jsonObject);

        return $create;
    }

    public function mapSubscriptionCardUpdate(SubscriptionCardUpdate $create)
    {
        return $this->mapSubscriptionCardUpdateFrom($create, $this->jsonObject);
    }
}
