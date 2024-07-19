<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\ThreedsInitializePreAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreatePaymentRequest;

class ThreedsInitializePreAuth extends IyzipayResource
{
    private $htmlContent;

    public static function create(CreatePaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/3dsecure/initialize/preauth', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return ThreedsInitializePreAuthMapper::create($rawResult)->jsonDecode()->mapThreedsInitializePreAuth(new ThreedsInitializePreAuth());
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
