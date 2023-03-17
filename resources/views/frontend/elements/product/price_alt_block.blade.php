@if($product->hasDiscount())
    <div class="prise-old">
        {{ $product->format_price_old }}
        <span class="val">@lang('frontend/product/index.uah')</span>
    </div>
@endif
<div class="prise-new">{{ $product->format_price }}
    <span class="val">@lang('frontend/product/index.uah')</span>
</div>