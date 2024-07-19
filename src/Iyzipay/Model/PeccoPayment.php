<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PeccoPaymentMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePeccoPaymentRequest;

class PeccoPayment extends PaymentResource
{
    private $token;

    public static function create(CreatePeccoPaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/pecco/auth', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PeccoPaymentMapper::create($rawResult)->jsonDecode()->mapPeccoPayment(new PeccoPayment());
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }
}
