<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PayWithIyzicoMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrievePayWithIyzicoRequest;

class PayWithIyzico extends PaymentResource
{
    private $token;
    private $callbackUrl;

    public static function retrieve(RetrievePayWithIyzicoRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/checkoutform/auth/ecom/detail', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PayWithIyzicoMapper::create($rawResult)->jsonDecode()->mapPayWithIyzico(new PayWithIyzico());
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
    }
}
