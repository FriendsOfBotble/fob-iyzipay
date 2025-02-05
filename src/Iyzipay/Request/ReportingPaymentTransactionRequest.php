<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Request;

use FriendsOfBotble\Iyzipay\Iyzipay\JsonBuilder;
use FriendsOfBotble\Iyzipay\Iyzipay\Request;

class ReportingPaymentTransactionRequest extends Request
{
    private $transactionDate;
    private $page;

    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getJsonObject()
    {
        return JsonBuilder::fromJsonObject(parent::getJsonObject())
            ->add('transactionDate', $this->getTransactionDate())
            ->add('page', $this->getPage())
            ->getObject();
    }
}
