<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\BasicThreedsInitializeMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateBasicPaymentRequest;

class BasicThreedsInitialize extends IyzipayResource
{
    private $htmlContent;

    public static function create(CreateBasicPaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/3dsecure/initialize/basic', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return BasicThreedsInitializeMapper::create($rawResult)->jsonDecode()->mapBasicThreedsInitialize(new BasicThreedsInitialize());
    }

    public function getHtmlContent()
    {
        return $this->htmlContent;
    }

    public function setHtmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }
}
