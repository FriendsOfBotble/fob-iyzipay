<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\BasicThreedsInitializePreAuthMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateBasicPaymentRequest;

class BasicThreedsInitializePreAuth extends IyzipayResource
{
    private $htmlContent;

    public static function create(CreateBasicPaymentRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/3dsecure/initialize/preauth/basic', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return BasicThreedsInitializePreAuthMapper::create($rawResult)->jsonDecode()->mapBasicThreedsInitializePreAuth(new BasicThreedsInitializePreAuth());
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
