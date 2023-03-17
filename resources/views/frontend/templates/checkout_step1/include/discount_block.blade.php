@auth('web')
    @if(!empty(Auth::guard('web')->user()->discount) && CartHelper::getDiscount())
        <div class="basket__summarize-item">
            <div class="basket__summarize-text">
                @lang('frontend/checkout/index.discount')
            </div>
            <div class="basket__summarize-prise basket__summarize--semi">
                @if(Auth::guard('web')->user()->is_percentage)
                    <span>{{ Auth::guard('web')->user()->discount }}</span>
                    <span>&#37;</span>
                @else
                    <span class="js-checkout-discount">{{ CartHelper::getDiscount() }}</span>
                    <span>@lang('frontend/product/index.uah')</span>
                @endif
            </div>
        </div>
    @endif
@endauth