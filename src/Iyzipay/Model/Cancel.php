<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\CancelMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateCancelRequest;

class Cancel extends IyzipayResource
{
    private $paymentId;
    private $price;
    private $currency;
    private $connectorName;
    private $authCode;

    public static function create(CreateCancelRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/cancel', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return CancelMapper::create($rawResult)->jsonDecode()->mapCancel(new Cancel());
    }

    public function getPaymentId()
    {
        return $this->paymentId;
    }

    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    public function getConnectorName()
    {
        return $this->connectorName;
    }

    public function setConnectorName($connectorName)
    {
        $this->connectorName = $connectorName;
    }

    public function getAuthCode()
    {
        return $this->authCode;
    }

    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
    }
}
