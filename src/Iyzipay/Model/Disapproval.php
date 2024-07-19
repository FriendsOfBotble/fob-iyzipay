<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\DisapprovalMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\CreateApprovalRequest;

class Disapproval extends IyzipayResource
{
    private $paymentTransactionId;

    public static function create(CreateApprovalRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/payment/iyzipos/item/disapprove', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return DisapprovalMapper::create($rawResult)->jsonDecode()->mapDisapproval(new Disapproval());
    }

    public function getPaymentTransactionId()
    {
        return $this->paymentTransactionId;
    }

    public function setPaymentTransactionId($paymentTransactionId)
    {
        $this->paymentTransactionId = $paymentTransactionId;
    }
}
