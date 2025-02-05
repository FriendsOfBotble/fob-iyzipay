<?php

namespace FriendsOfBotble\Iyzipay\Iyzipay\Model\Mapper;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\ReportingPaymentDetail;

class ReportingPaymentDetailMapper extends ReportingPaymentDetailResourceMapper
{
    public static function create($rawResult = null)
    {
        return new ReportingPaymentDetailMapper($rawResult);
    }

    public function mapReportingPaymentDetailFrom(ReportingPaymentDetail $create, $jsonObject)
    {
        parent::mapReportingPaymentDetailResourceFrom($create, $jsonObject);

        return $create;
    }

    public function mapReportingPaymentDetail(ReportingPaymentDetail $create)
    {
        return $this->mapReportingPaymentDetailFrom($create, $this->jsonObject);
    }
}
