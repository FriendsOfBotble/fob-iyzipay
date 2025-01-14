<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\BasicPaymentPostAuth;

class BasicPaymentPostAuthMapper extends BasicPaymentResourceMapper
{
    public static function create($rawResult = null)
    {
        return new BasicPaymentPostAuthMapper($rawResult);
    }

    public function mapBasicPaymentPostAuthFrom(BasicPaymentPostAuth $postAuth, $jsonObject)
    {
        parent::mapBasicPaymentResourceFrom($postAuth, $jsonObject);

        return $postAuth;
    }

    public function mapBasicPaymentPostAuth(BasicPaymentPostAuth $postAuth)
    {
        return $this->mapBasicPaymentPostAuthFrom($postAuth, $this->jsonObject);
    }
}
