<div class="prod-cart">
    @include('frontend.elements.product.status', ['product' => $product])
    <div class="prod-cart__top">
        <a href="{{ $product->alias }}">
            <div class="prod-cart__img">
                <picture>
                    <source type="image/webp" srcset="{{ $product->cover->getUrl('prod_md', true) }}">
                    <img src="{{ $product->cover->getUrl('prod_md') }}"
                         alt="{{ $product->cover->getImageAlt() }}"
                         title="{{ $product->cover->getImageTitle() }}">
                </picture>
            </div>
            <div class="prod-cart__descr">
                {{ $product->name }}
            </div>
        </a>
    </div>
    <div class="star-box">
        <div class="star js_review star-fill hidden-mob" data-mark="{{ $product->rating }}"
             data-star-on="{{ url('/assets/frontend/images/on.svg') }}"
             data-star-off="{{ url('/assets/frontend/images/off.svg') }}"></div>
    </div>

    @include('frontend.elements.product.price', ['product' => $product])
</div>