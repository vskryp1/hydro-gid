@if($product->original_price > 0)
    <div class="prod-cart__bottom">
        <div class="prod-cart__prise">
            @if($product->hasDiscount())
                <div class="prod-cart__prise-old">
                    {{ $product->format_price_old }}
                    <span class="val">
                            @lang('frontend/product/index.uah')
                     </span>
                </div>
            @endif
            <div class="prod-cart__prise-new">
                {{ $product->format_price }}
                <span class="val">
                        @lang('frontend/product/index.uah')
                 </span>
            </div>
        </div>
    </div>
@endif


