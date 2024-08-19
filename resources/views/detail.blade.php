@if ($payment)
    <div class="mt-4">
        <p>
            <span>{{ trans('plugins/payment::payment.payment_id') }}: </span>
            {{ Arr::get($payment, 'paymentId') }}
        </p>
        <p>{{ trans('plugins/payment::payment.amount') }}: {{ Arr::get($payment, 'paidPrice') }} {{ Arr::get($payment, 'currency') }}</p>
        <hr>

        @include('plugins/payment::partials.view-payment-source')
    </div>
@endif
