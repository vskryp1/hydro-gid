@if($relatedProducts->isNotEmpty())
    <div class="sentence" style="background-image: url(../images/serv-bg-comp.png);">
        <div class="container">
            <div class="benefits__title">@lang('frontend/product/index.related_products')</div>
            <div class="slider-prod js-slider-prod">
                @foreach($relatedProducts as $product)
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif