<?php

namespace FriendsOfBotble\Iyzipay\Services\Abstracts;

use FriendsOfBotble\Iyzipay\Iyzipay\Model\Payment;
use FriendsOfBotble\Iyzipay\Iyzipay\Request\RetrievePaymentRequest;
use FriendsOfBotble\Iyzipay\Services\Iyzipay;
use Botble\Payment\Services\Traits\PaymentErrorTrait;
use Botble\Support\Services\ProduceServiceInterface;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

abstract class IyzipayPaymentAbstract implements ProduceServiceInterface
{
    use PaymentErrorTrait;

    protected string $paymentCurrency;

    protected Client $client;

    protected bool $supportRefundOnline;

    public function __construct()
    {
        $this->paymentCurrency = config('plugins.payment.payment.currency');

        $this->totalAmount = 0;

        $this->supportRefundOnline = true;
    }

    public function getSupportRefundOnline()
    {
        return $this->supportRefundOnline;
    }

    public function setCurrency($currency)
    {
        $this->paymentCurrency = $currency;

        return $this;
    }

    public function getCurrency()
    {
        return $this->paymentCurrency;
    }

    public function getPaymentDetails($payment)
    {
        try {
            $transactionRequest = new RetrievePaymentRequest();
            $transactionRequest->setLocale(app()->getLocale());
            $transactionRequest->setPaymentId($payment->charge_id);
            $response = Payment::retrieve($transactionRequest, (new Iyzipay())->getCredentials());

            if ($response->getStatus() == 'success') {
                return $response;
            }
        } catch (Exception $exception) {
            $this->setErrorMessageAndLogging($exception, 1);

            return false;
        }

        return false;
    }

    public function refundOrder($paymentId, $amount, $optionRefunds)
    {
        $response = (new Iyzipay())->refundOrder($paymentId, $optionRefunds);

        if ($response->getStatus() == 'success') {
            return [
                'error' => false,
                'data' => [
                    'refund_redirect_url' => $response->getUrl(),
                ],
            ];
        }

        return [
            'error' => true,
            'message' => $response->getErrorMessage(),
        ];
    }

    public function execute(Request $request)
    {
        try {
            return $this->makePayment($request);
        } catch (Exception $exception) {
            $this->setErrorMessageAndLogging($exception, 1);

            return false;
        }
    }

    abstract public function makePayment(Request $request);

    abstract public function afterMakePayment(Request $request);
}
