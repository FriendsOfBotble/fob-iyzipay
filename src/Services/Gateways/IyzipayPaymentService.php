<?php

namespace FriendsOfBotble\Iyzipay\Services\Gateways;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Currency;
use FriendsOfBotble\Iyzipay\Services\Abstracts\IyzipayPaymentAbstract;
use Illuminate\Http\Request;

class IyzipayPaymentService extends IyzipayPaymentAbstract
{
    public function makePayment(Request $request)
    {
    }

    public function afterMakePayment(Request $request)
    {
    }

    public function supportedCurrencyCodes(): array
    {
        return [
            Currency::TL,
            Currency::EUR,
            Currency::USD,
            Currency::GBP,
            Currency::IRR,
            Currency::NOK,
            Currency::RUB,
            Currency::CHF,
        ];
    }
}
