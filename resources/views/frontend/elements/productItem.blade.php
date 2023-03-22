@isset($product)
    <div class="prod-cart">
        @include('frontend.elements.product.status', ['product' => $product])
        <div class="prod-cart__addto">
            @auth('web')
                @include('frontend.elements.product.lists_buttons.compare_list_btn')
                @include('frontend.elements.product.lists_buttons.wishlist_btn')
            @endauth
        </div>
        <div class="prod-cart__top">
            <a href="{{ $product->alias }}">
                <div class="prod-cart__img">
                    <picture>
                        <source type="image/webp" srcset="{{ $product->cover->getUrl('prod_md', true) }}">
                        <img src="{{ $product->cover->getUrl('prod_md') }}"
                             alt="{{ $product->cover->getImageAlt() }}"
                             title="{{ $product->cover->getImageTitle() }}"/>
                    </picture>
                </div>
                <div class="prod-cart__descr">
                    {{ $product->name }}
                </div>
            </a>
        </div>
{{--        <div class="star-box">--}}
{{--            @if($product->rating_calculate)--}}
{{--            <div data-mark="{{ round($product->product_reviews->average('rating')) }}"--}}
{{--                 data-star-on="{{ asset('/assets/frontend/images/on.svg') }}"--}}
{{--                 data-star-off="{{ asset('/assets/frontend/images/off.svg') }}"--}}
{{--                 class="star js_review star-fill hidden-mob"></div>--}}
{{--                @else--}}
{{--                <div data-mark="{{ $product->rating }}"--}}
{{--                     data-star-on="{{ asset('/assets/frontend/images/on.svg') }}"--}}
{{--                     data-star-off="{{ asset('/assets/frontend/images/off.svg') }}"--}}
{{--                     class="star js_review star-fill hidden-mob"></div>--}}
{{--            @endif--}}
{{--        </div>--}}
        @include('frontend.elements.product.price', ['product' => $product])
    </div>
@endisset
