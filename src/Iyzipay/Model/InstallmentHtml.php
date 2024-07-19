<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\InstallmentHtmlMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveInstallmentInfoRequest;

class InstallmentHtml extends IyzipayResource
{
    private $htmlContent;

    public static function retrieve(RetrieveInstallmentInfoRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/installment/html/horizontal', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return InstallmentHtmlMapper::create($rawResult)->jsonDecode()->mapInstallmentHtml(new InstallmentHtml());
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
