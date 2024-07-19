@php $iyzipayStatus = get_payment_setting('status', IYZIPAY_PAYMENT_METHOD_NAME); @endphp
<table class="table payment-method-item">
    <tbody>
    <tr class="border-pay-row">
        <td class="border-pay-col"><i class="fa fa-theme-payments"></i></td>
        <td style="width: 20%;">
            <img class="filter-black" src="{{ url('vendor/core/plugins/iyzipay/images/iyzipay.png') }}"
                 alt="Iyzipay">
        </td>
        <td class="border-right">
            <ul>
                <li>
                    <a href="https://www.iyzico.com" target="_blank">{{ __('Iyzipay (by Iyzico)') }}</a>
                    <p>{{ __('Customer can buy product and pay directly using Visa, Credit card via :name', ['name' => 'Iyzipay']) }}</p>
                </li>
            </ul>
        </td>
    </tr>
    <tr class="bg-white">
        <td colspan="3">
            <div class="float-start" style="margin-top: 5px;">
                <div
                    class="payment-name-label-group @if (get_payment_setting('status', IYZIPAY_PAYMENT_METHOD_NAME) == 0) hidden @endif">
                    <span class="payment-note v-a-t">{{ trans('plugins/payment::payment.use') }}:</span> <label
                        class="ws-nm inline-display method-name-label">{{ get_payment_setting('name', IYZIPAY_PAYMENT_METHOD_NAME) }}</label>
                </div>
            </div>
            <div class="float-end">
                <a class="btn btn-secondary toggle-payment-item edit-payment-item-btn-trigger @if ($iyzipayStatus == 0) hidden @endif">{{ trans('plugins/payment::payment.edit') }}</a>
                <a class="btn btn-secondary toggle-payment-item save-payment-item-btn-trigger @if ($iyzipayStatus == 1) hidden @endif">{{ trans('plugins/payment::payment.settings') }}</a>
            </div>
        </td>
    </tr>
    <tr class="paypal-online-payment payment-content-item hidden">
        <td class="border-left" colspan="3">
            {!! Form::open() !!}
            {!! Form::hidden('type', IYZIPAY_PAYMENT_METHOD_NAME, ['class' => 'payment_type']) !!}
            <div class="row">
                <div class="col-sm-6">
                    <ul>
                        <li>
                            <label>{{ trans('plugins/payment::payment.configuration_instruction', ['name' => 'Iyzipay']) }}</label>
                        </li>
                        <li class="payment-note">
                            <p>{{ trans('plugins/payment::payment.configuration_requirement', ['name' => 'Iyzipay']) }}:</p>
                            <ul class="m-md-l" style="list-style-type:decimal">
                                <li style="list-style-type:decimal">
                                    <a href="https://sandbox-merchant.iyzipay.com" target="_blank">
                                        {{ __('Register an account on :name', ['name' => 'Iyzipay']) }}
                                    </a>
                                </li>
                                <li style="list-style-type:decimal">
                                    <p>{{ __('After registration at :name, you will have API & Secret keys', ['name' => 'Iyzipay (by Iyzico)']) }}</p>
                                </li>
                                <li style="list-style-type:decimal">
                                    <p>{{ __('Enter API key, Secret into the box in right hand') }}</p>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <div class="well bg-white">
                        <div class="form-group mb-3">
                            <label class="text-title-field"
                                   for="iyzipay_name">{{ trans('plugins/payment::payment.method_name') }}</label>
                            <input type="text" class="next-input" name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_name"
                                   id="iyzipay_name" data-counter="400"
                                   value="{{ get_payment_setting('name', IYZIPAY_PAYMENT_METHOD_NAME, __('Online payment via :name', ['name' => 'Iyzipay'])) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-title-field" for="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_description">{{ trans('core/base::forms.description') }}</label>
                            <textarea class="next-input" name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_description" id="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_description">{{ get_payment_setting('description', IYZIPAY_PAYMENT_METHOD_NAME) }}</textarea>
                        </div>

                        <p class="payment-note">
                            {{ trans('plugins/payment::payment.please_provide_information') }} <a target="_blank" href="https://sandbox-merchant.iyzipay.com">Iyzipay</a>:
                        </p>
                        <div class="form-group mb-3">
                            <label class="text-title-field" for="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_api_key">{{ __('API Key') }}</label>
                            <input type="text" class="next-input"
                                   name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_api_key" id="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_api_key"
                                   value="{{ get_payment_setting('api_key', IYZIPAY_PAYMENT_METHOD_NAME) }}" placeholder="pk_****">
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-title-field" for="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_secret">{{ __('Secret Key') }}</label>
                            <input type="password" class="next-input" id="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_secret"
                                   name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_secret"
                                   value="{{ get_payment_setting('secret', IYZIPAY_PAYMENT_METHOD_NAME) }}" placeholder="sk_****">
                        </div>

                        <div class="form-group mb-3">
                            <label class="text-title-field" for="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_payment_type">{{ __('Payment Type') }}</label>
                            <div class="ui-select-wrapper">
                                <select name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_payment_type" class="ui-select select-search-full" id="{{ IYZIPAY_PAYMENT_METHOD_NAME }}_payment_type">
                                    <option value="CheckoutForm" @if (get_payment_setting('payment_type', IYZIPAY_PAYMENT_METHOD_NAME, 'CheckoutForm') == 'CheckoutForm') selected @endif>Checkout Form</option>
                                    <option value="PayWithIyzico" @if (get_payment_setting('payment_type', IYZIPAY_PAYMENT_METHOD_NAME, 'CheckoutForm') == 'PayWithIyzico') selected @endif>Pay With Iyzico</option>
                                </select>
                                <svg class="svg-next-icon svg-next-icon-size-16">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#select-chevron"></use>
                                </svg>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            {!! Form::hidden('payment_' . IYZIPAY_PAYMENT_METHOD_NAME . '_mode', 1) !!}
                            <label class="next-label">
                                <input type="checkbox" value="0" name="payment_{{ IYZIPAY_PAYMENT_METHOD_NAME }}_mode" @if (setting('payment_' . IYZIPAY_PAYMENT_METHOD_NAME . '_mode') == 0) checked @endif>
                                {{ trans('plugins/payment::payment.sandbox_mode') }}
                            </label>
                        </div>

                        {!! apply_filters(PAYMENT_METHOD_SETTINGS_CONTENT, null, IYZIPAY_PAYMENT_METHOD_NAME) !!}
                    </div>
                </div>
            </div>
            <div class="col-12 bg-white text-end">
                <button class="btn btn-warning disable-payment-item @if ($iyzipayStatus == 0) hidden @endif"
                        type="button">{{ trans('plugins/payment::payment.deactivate') }}</button>
                <button
                    class="btn btn-info save-payment-item btn-text-trigger-save @if ($iyzipayStatus == 1) hidden @endif"
                    type="button">{{ trans('plugins/payment::payment.activate') }}</button>
                <button
                    class="btn btn-info save-payment-item btn-text-trigger-update @if ($iyzipayStatus == 0) hidden @endif"
                    type="button">{{ trans('plugins/payment::payment.update') }}</button>
            </div>
            {!! Form::close() !!}
        </td>
    </tr>
    </tbody>
</table>
