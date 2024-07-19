<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\ReportingPaymentTransactionMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\ReportingPaymentTransactionRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class ReportingPaymentTransaction extends ReportingPaymentTransactionResource
{
    public static function create(ReportingPaymentTransactionRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/reporting/payment/transactions' . RequestStringBuilder::requestToStringQuery($request, 'reportingTransaction');
        $rawResult = parent::httpClient()->getV2($uri, parent::getHttpHeadersV2($uri, null, $options));

        return ReportingPaymentTransactionMapper::create($rawResult)->jsonDecode()->mapReportingPaymentTransaction(new ReportingPaymentTransaction());
    }
}
