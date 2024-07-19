<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\IyzipayResource;
use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\PayoutCompletedTransactionListMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrieveTransactionsRequest;

class PayoutCompletedTransactionList extends IyzipayResource
{
    private $payoutCompletedTransactions;

    public static function retrieve(RetrieveTransactionsRequest $request, Options $options)
    {
        $rawResult = parent::httpClient()->post($options->getBaseUrl() . '/reporting/settlement/payoutcompleted', parent::getHttpHeaders($request, $options), $request->toJsonString());

        return PayoutCompletedTransactionListMapper::create($rawResult)->jsonDecode()->mapPayoutCompletedTransactionList(new PayoutCompletedTransactionList());
    }

    public function getPayoutCompletedTransactions()
    {
        return $this->payoutCompletedTransactions;
    }

    public function setPayoutCompletedTransactions($payoutCompletedTransactions)
    {
        $this->payoutCompletedTransactions = $payoutCompletedTransactions;
    }
}
