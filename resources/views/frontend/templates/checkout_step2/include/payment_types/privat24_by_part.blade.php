<div class="form-group">
    <label>{{ __('frontend.payparts_credit_term') }}</label>
    <select id="payparts_month" name='payparts_month' class="form-control select-list">
        @for ($month=config('app.pb_payparts_credit_months_from'); $month <= config('app.pb_payparts_credit_months_to') ;$month++)
            <option data-credit-term="{{ $month - 1 }}" value='{{$month}}'>{{ $month - 1 }} {{__(trans_choice('frontend.payparts_month', $month - 1))}}</option>
        @endfor
    </select>
    <span class="color-green font-weight-bold">
        <span>{{ __('frontend.payparts_payment_by_month') }} </span>
        <span class="payparts_month"></span>
        <span> {{ __('frontend/product/index.uah') }}</span>
    </span>
</div>