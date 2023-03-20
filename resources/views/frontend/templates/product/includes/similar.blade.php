@if($similarProducts->isNotEmpty())
    <div class="benefits">
        <div class="benefits__gradient"></div>
        <div class="container">
            <div class="benefits__title">@lang('frontend/product/index.similar_products')</div>
            <div class="slider-prod js-slider-prod">
                @foreach($similarProducts as $product)
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif