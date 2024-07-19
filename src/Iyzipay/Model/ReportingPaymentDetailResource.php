<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;

class ReportingPaymentDetailResource extends IyzipayResource
{
    private $payments;

    public function getPayments()
    {
        return $this->payments;
    }

    public function setPayments($payments)
    {
        $this->payments = $payments;
    }
}
