@if (get_payment_setting('status', IYZIPAY_PAYMENT_METHOD_NAME) == 1)
    <li class="list-group-item">
        <input class="magic-radio js_payment_method" type="radio" name="payment_method" id="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}"
               value="{{ IYZIPAY_PAYMENT_METHOD_NAME }}" data-bs-toggle="collapse" data-bs-target=".payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_wrap"
               data-parent=".list_payment_method"
               @if ((session('selected_payment_method') ?: setting('default_payment_method')) == IYZIPAY_PAYMENT_METHOD_NAME) checked @endif
        >
        <label for="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}">{{ get_payment_setting('name', IYZIPAY_PAYMENT_METHOD_NAME) }}</label>
        <div class="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_wrap payment_collapse_wrap collapse @if ((session('selected_payment_method') ?: setting('default_payment_method')) == IYZIPAY_PAYMENT_METHOD_NAME) show @endif">
            <p>{!! BaseHelper::clean(get_payment_setting('description', IYZIPAY_PAYMENT_METHOD_NAME, __('Payment with Iyzipay (by Iyzico)'))) !!}</p>

            @php $supportedCurrencies = (new \FriendsOfBotble\Iyzipay\Services\Gateways\IyzipayPaymentService)->supportedCurrencyCodes(); @endphp
            @if (!in_array(get_application_currency()->title, $supportedCurrencies) && ! get_application_currency()->replicate()->newQuery()->where('title', 'TRY')->exists())
                <div class="alert alert-warning" style="margin-top: 15px;">
                    {{ __(":name doesn't support :currency. List of currencies supported by :name: :currencies.", ['name' => 'Iyzipay', 'currency' => get_application_currency()->title, 'currencies' => implode(', ', $supportedCurrencies)]) }}
                    @php
                        $currencies = get_all_currencies();

                        $currencies = $currencies->filter(function ($item) use ($supportedCurrencies) { return in_array($item->title, $supportedCurrencies); });
                    @endphp
                    @if (count($currencies))
                        <div style="margin-top: 10px;">{{ __('Please switch currency to any supported currency') }}:&nbsp;&nbsp;
                            @foreach ($currencies as $currency)
                                <a href="{{ route('public.change-currency', $currency->title) }}" @if (get_application_currency_id() == $currency->id) class="active" @endif><span>{{ $currency->title }}</span></a>
                                @if (!$loop->last)
                                    &nbsp; | &nbsp;
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </li>
@endif