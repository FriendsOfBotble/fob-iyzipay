<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\InstallmentInfoMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveInstallmentInfoRequest;

class InstallmentInfo extends IyzipayResource
{
    private $installmentDetails;

    public static function retrieve(RetrieveInstallmentInfoRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/installment', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return InstallmentInfoMapper::create($rawResult)->jsonDecode()->mapInstallmentInfo(new InstallmentInfo());
    }

    public function getInstallmentDetails()
    {
        return $this->installmentDetails;
    }

    public function setInstallmentDetails($installmentDetails)
    {
        $this->installmentDetails = $installmentDetails;
    }
}
