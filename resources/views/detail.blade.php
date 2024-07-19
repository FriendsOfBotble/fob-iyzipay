@if ($payment)
    <p><span>{{ trans('plugins/payment::payment.payment_id') }}: </span>
        {{ $payment->getPaymentId() }}
    </p>
    <p>{{ trans('plugins/payment::payment.amount') }}: {{ $payment->getPaidPrice() }} {{ $payment->getCurrency() }}</p>
    <hr>

    @include('plugins/payment::partials.view-payment-source')
@endif
