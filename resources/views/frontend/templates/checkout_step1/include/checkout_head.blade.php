<div class="checkout__title">
    <div class="container">
        @lang('frontend/checkout/index.make_order')
    </div>
</div>
<div class="checkout__step-line">
    <div class="container">
        <div class="checkout__step-item checkout__step-itemfirst">
            1. @lang('frontend/checkout/index.contacts')
        </div>
        <div class="checkout__step-item {{ $step }}">
            2. @lang('frontend/checkout/index.choose_delivery_payment')
        </div>
    </div>
</div>
