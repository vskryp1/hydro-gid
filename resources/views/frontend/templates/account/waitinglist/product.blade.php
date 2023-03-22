<div class="item-prod col-lg-3 js_product">
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
        <ul class="prod-cart__list">
            @foreach($product->filter_values->groupByFiltersPosition() as $filterValue)
                <li>
                    {{ $filterValue->first()->filter->name }}: {{ $filterValue->implode('name', ', ') }}
                </li>
            @endforeach
        </ul>
        <div class="star-box">
            <div class="star js_review star-fill hidden-mob" data-mark="{{ $product->rating }}"
                 data-star-on="{{ url('/assets/frontend/images/on.svg') }}"
                 data-star-off="{{ url('/assets/frontend/images/off.svg') }}"></div>
        </div>

        @include('frontend.elements.product.price', ['product' => $product])

        @switch((string) $product->availability)
            @case(ProductAvailability::NOT_AVAILABLE)
            <div class="not-available-h">
            <span class="not-available-txt">
                {{ __('frontend/product/index.out_of_stock') }}
            </span>
            </div>
            @break

            @case(ProductAvailability::UNDER_ORDER)
            <div class="prod-cart__order">
                    <span class="ttl">
                        @lang('frontend/product/index.under_order')
                    </span>
                <span class="discr">
                        @lang('frontend/product/index.delivery_date') - {{ $product->under_order_weeks }} @lang(trans_choice('frontend/product/index.weeks', $product->under_order_weeks))
                </span>
            </div>
            <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
               class="js-add-to-cart prod-cart__buy"
               data-fancybox=""
               data-src="#modal-basket"
               data-category="{{ $product->getMainCategoryAttribute()->name }}"
               data-name="{{ $product->name }}"
               data-sku="{{ $product->sku }}"
               data-price="{{ $product->format_price }}"
               data-brand="{{ ShopHelper::setting("site_name") }}">
                @lang('frontend/product/index.to_order')
            </a>
            @break

            @case(ProductAvailability::EXPECTED_DELIVERY)
            <div class="prod-cart__awaiting">
                    <span class="ttl">
                        @lang('frontend/product/index.expected_delivery')
                    </span>
                <span class="discr">
                        @lang('frontend/product/index.delivery_date') - @lang(trans_choice('frontend/product/index.expected_days', Carbon::now()->diffInDays($product->expected_at)+1))
                    </span>
            </div>
            <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
               class="js-add-to-cart prod-cart__buy"
               data-fancybox=""
               data-src="#modal-basket"
               data-category="{{ $product->getMainCategoryAttribute()->name }}"
               data-name="{{ $product->name }}"
               data-sku="{{ $product->sku }}"
               data-price="{{ $product->format_price }}"
               data-brand="{{ ShopHelper::setting("site_name") }}">
                @lang('frontend/product/index.buy_in_one_click')
            </a>
            @break

            @default
            @include('frontend.elements.forms.temp_order')
            <a data-fancybox data-src="#modal-buy_per_click" href="#" class="prod-cart__buy">
                @lang('frontend/product/index.buy_in_one_click')
            </a>
        @endswitch
        <div class="not-available-h">
            <a data-remove="{{ route('ajax.user.remove.from.waitinglist', [
                'user_id' => auth('web')->id(),
                'rowId'   => $rowId,
            ]) }}"
               data-method="POST"
               class="report js_remove_from_waitinglist">
                @lang('frontend/profile/index.remove_from_waitinglist')
            </a>
        </div>
    </div>
</div>