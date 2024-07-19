<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper\ReportingPaymentDetailMapper;
use FriendsOfBotble\Iyzipay\Iyzipay\Options;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\ReportingPaymentDetailRequest;
use FriendsOfBotble\Iyzipay\Iyzipay\RequestStringBuilder;

class ReportingPaymentDetail extends ReportingPaymentDetailResource
{
    public static function create(ReportingPaymentDetailRequest $request, Options $options)
    {
        $uri = $options->getBaseUrl() . '/v2/reporting/payment/details' . RequestStringBuilder::requestToStringQuery($request, 'reporting');
        $rawResult = parent::httpClient()->getV2($uri, parent::getHttpHeadersV2($uri, null, $options));

        return ReportingPaymentDetailMapper::create($rawResult)->jsonDecode()->mapReportingPaymentDetail(new ReportingPaymentDetail());
    }
}
