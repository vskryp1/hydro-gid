<section class="product-info">
    <div class="container">
        <div class="product-info__top">
            <div class="product-info__left">
                <div class="products__title">
                    <h1 class="products__title">{{ $product->name }}</h1>
                </div>
                <div class="prod-article">
                    @lang('frontend/product/index.article'):
                    <span>{{ $product->sku }}</span>
                    <i class="icon icon-copy js-copy"></i>
                    <input class="input-copy" type="text" value="{{ $product->sku }}"/>
                </div>
            </div>
            <div class="product-info__right">
                <a href="{{ route('frontend.generate.pdf', $product) }}"
                    class="main-btn generate"
                    target="_blank">@lang('frontend/product/index.generate_pdf')</a>
                <div class="btn-info"
                     data-toggle="tooltip"
                     data-placement="top"
                     title="{{ShopHelper::setting('generate-pdf-text')}}">
                    ?
                </div>
            </div>
        </div>
        <div class="two-column-prod row">
            <div class="item-prod-left">
                <div class="row">
                    <div class="product-main-section col-xs-6">
                        <div class="product-main-slider">
                            <div class="product-one-slider__img">
                                @forelse($product->images as $image)
                                    <div class="slide-item">
                                        <a href="{{ asset($image->image)}}"
                                           data-fancybox="images">
                                            <picture>
                                                <source type="image/webp" class="lazy-srcset" data-srcset="{{ $image->getUrl('prod_xl', true) }}">
                                                <img class="lazy" data-src="{{ $image->getUrl('prod_xl') }}"
                                                     alt="{{ $image->getImageAlt() }}"
                                                     title="{{ $image->getImageTitle() }}"/>
                                            </picture>
                                        </a>
                                    </div>
                                @empty
                                    <div class="slide-item">
                                        <a href="{{ $product->cover->image }}">
                                            <picture>
                                                <source type="image/webp" class="lazy-srcset" data-srcset="{{ $product->cover->getUrl('prod_xl', true) }}">
                                                <img class="lazy" data-src="{{ $product->cover->getUrl('prod_xl') }}"
                                                     alt="{{ $product->cover->getImageAlt() }}"
                                                     title="{{ $product->cover->getImageTitle() }}"/>
                                            </picture>
                                        </a>
                                    </div>
                                @endforelse
                            </div>
                            <div class="product-one-slider__thumb">
                                @foreach($product->images as $image)
                                    <div class="slide-item">
                                        <picture>
                                            <source type="image/webp" class="lazy-srcset" data-srcset="{{ $image->getUrl('prod_sm', true) }}">
                                            <img class="lazy" data-src="{{ $image->getUrl('prod_sm') }}"
                                                 alt="{{ $image->getImageAlt() }}"
                                                 title="{{ $image->getImageTitle() }}">
                                        </picture>
                                    </div>
                                @endforeach
                                @if($product->video)
                                    <div class="slide-item slide-item-video">
                                        <a href="https://youtu.be/{{ $product->video }}" data-fancybox rel=”nofollow”>
                                            <div class="icon icon-youtube"></div>
                                            <picture>
                                                <source type="image/webp" class="lazy-srcset" data-srcset="{{ $product->cover->getUrl('prod_sm', true) }}">
                                                <img class="lazy" data-src="{{ $product->cover->getUrl('prod_sm') }}"
                                                     alt="{{ $product->cover->getImageAlt() }}">
                                            </picture>
                                        </a>
                                    </div>
                                @endif
                            </div>
                            @if(count($baseFilters) > 0)
                                <div class="characterisrics-prod">
                                    <span class="ttl">@lang('frontend/product/index.main_params'):</span>
                                    <ul>
                                        @foreach($baseFilters as $filter)
                                            <li>{{ $filter->name }}
                                                : {{ $filter->filter_values->pluck('name')->implode(', ') }}</li>
                                        @endforeach
                                    </ul>
                                    <button href="javascript:void(0);" class="btn-more-chk js-btn-more-chk">
                                        @lang('frontend/product/index.all_params')
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="choose-config-section col-xs-6">
                        @if($product->is_disable_price || $product->original_price == 0)
                            <div class="row">
                                <div class="about-prod">

                                    <div class="flex-row about-prod__btns-wrap">
                                        @switch((string) $product->availability)
                                            @case(ProductAvailability::NOT_AVAILABLE)
                                                <div class="not-avail">
                                                    @auth('web')
                                                        <a data-put="{{ route('ajax.user.put.in.waitinglist', [
                                                                'user_id' => auth('web')->id(),
                                                                'product' => $product, ]) }}"
                                                           data-method="POST"
                                                           data-inlist-message="@lang('frontend/profile/index.waitinglist_messages.exists')"
                                                           class="report
                                                   @if(auth('web')->user()->hasProductInWaiting($product)) active @endif
                                                    js_put_in_waitinglist">
                                                            @lang('frontend/product/index.notify_when_appears')
                                                        </a>
                                                    @else
                                                        <a href="#" data-fancybox data-src="#modal" class="report">
                                                            @lang('frontend/product/index.notify_when_appears')
                                                        </a>
                                                    @endauth
                                                </div>
                                                @break
                                            @case(ProductAvailability::UNDER_ORDER)
                                                <div class="prod-cart__order" style="display: block;">
                                            <span class="ttl">
                                                    @lang('frontend/product/index.under_order')
                                            </span>
                                                    <span class="discr">
                                                    @lang('frontend/product/index.delivery_date') - {{ $product->under_order_weeks }} @lang(trans_choice('frontend/product/index.weeks', $product->under_order_weeks))
                                            </span>
                                                    <a data-href="{{ route('ajax.cart.add', $product) }}"
                                                       style="display: block;" data-method="POST"
                                                       class="js-add-to-cart prod-cart__buy" data-fancybox=""
                                                       data-src="#modal-basket"
                                                       data-category="{{ $product->getMainCategoryAttribute()->name }}"
                                                       data-name="{{ $product->name }}"
                                                       data-sku="{{ $product->sku }}"
                                                       data-price="{{ $product->format_price }}"
                                                       data-brand="{{ ShopHelper::setting("site_name") }}">
                                                        @lang('frontend/product/index.to_order')
                                                    </a>
                                                </div>
                                                @break
                                            @case(ProductAvailability::EXPECTED_DELIVERY)
                                                <div class="prod-cart__order" style="display: block;">
                                                <span class="ttl">
                                                        @lang('frontend/product/index.expected_delivery')
                                                </span>
                                                    <span class="discr">
                                                        @lang('frontend/product/index.delivery_date') - @lang(trans_choice('frontend/product/index.expected_days', Carbon::now()->diffInDays($product->expected_at)+1))
                                                </span>
                                                </div>
                                            @default
                                                <div class="prod-cart__order" style="display: block; height: 44px">
                                                </div>
                                        @endswitch
                                        <div class="cols modal__title">
                                            @lang('frontend/product/index.accounting_price_title')
                                        </div>
                                        <div class="cols">
                                            <a data-fancybox data-src="#modal-buy_per_click_is_accounting_price" href="#"
                                               class="main-btn main-btn--green btn-style_click">
                                                @lang('frontend/product/index.accounting_price')
                                            </a>
                                            @include('frontend.elements.product.lists_buttons.compare_list_btn', ['classes' => [ 'mark' ]])
                                            @include('frontend.elements.product.lists_buttons.wishlist_btn', ['classes' => [ 'mark' ]])
                                        </div>
                                    </div>
                                    @if($product->technical_doc_url)
                                        <div class="flex-row">
                                            <a href="{{ $product->technical_doc_url }}" target="_blank" class="btn-download">
                                                <i class="icon icon-download"></i>
                                                @lang('frontend/product/index.download_technical_doc')
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                        <div class="border-holder row between-xs">
                            <div class="column-left">
                                @if($product->status)
                                    <div class="prod-cart__status-box {{ $product->status->class }}"
                                         @if($product->status->color) style="background:{{ $product->status->color }}" @endif>
                                        <span>{{ $product->status->name }}</span>
                                    </div>
                                @endif
                                <div class="prod-status in-stock">{{ $product->availability->description }}</div>
                                <div class="prod-status">{{ $product->sale_type->description }}</div>
                            </div>
                            <div class="column-right">
                                <div class="star-box">
                                    @if($product->rating_calculate && $reviews->count())
                                        <div data-mark="{{ round($product->product_reviews->average('rating')) }}"
                                             data-star-on="{{ asset('/assets/frontend/images/on.svg') }}"
                                             data-star-off="{{ asset('/assets/frontend/images/off.svg') }}"
                                             class="star js_review star-fill hidden-mob"></div>
                                    @else
                                        <div data-mark="{{ $product->rating }}"
                                             data-star-on="{{ asset('/assets/frontend/images/on.svg') }}"
                                             data-star-off="{{ asset('/assets/frontend/images/off.svg') }}"
                                             class="star js_review star-fill hidden-mob"></div>
                                    @endif
                                    <a href="#scroll-review" class="review-qw js_scroll-review">
                                        {{ $product->product_reviews->count() }}
                                        {{ trans_choice('frontend/product/index.reviews_trans', $product->product_reviews->count(), [], App::getLocale()) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if($packages)
                            <div class="border-holder row middle-xs">
                                    <strong class="choose-config__title">
                                        {{ App\Helpers\ProductHelper::getFilterName($packages) }}:
                                    </strong>
                                @foreach($packages as $package)
                                    @if($package['product']->id == $product->id)
                                        <span class="config__memory active">{{$package['value']->name}}</span>
                                    @else
                                        <a href="{{ $package['product']->alias }}" class="config__memory">
                                            {{ $package['value']->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                        <div class="border-holder row middle-xs">
                            <form action="#">
                                @foreach($warranties as $key => $warranty)
                                    <div class="choose-settings">
                                        <input type="radio" id="radio-{{ $warranty->id }}"
                                               name="radio-group"
                                               class="js-warranty"
                                               data-warranty-id="{{ $warranty->id }}"
                                               @if($loop->first) checked @endif>
                                        <label for="radio-{{ $warranty->id }}">
                                            @lang('frontend/product/index.warranty')
                                            {{ $warranty->amount }}
                                            @lang(trans_choice('frontend/product/index.month', ($warranty->amount < 20 ? $warranty->amount : $warranty->amount % 10))){{ ($product->allow_default_warranty && $key != 0) ? ':' : '' }}
                                            @if($warranty->price_formatted > 0)
                                                <strong>
                                                    {{ $warranty->price_formatted }}
                                                    @lang('frontend/product/index.uah')
                                                </strong>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="row">
                            <div class="about-prod">
                                @if($product->original_price > 0)
                                    <div class="flex-row">
                                        <div class="cols">
                                            @include('frontend.elements.product.price_alt_block', ['product' => $product])
                                        </div>
                                        <div class="quantity-cart js_quantity">
                                            <span class="js_minus btn-count btn-count--minus btn-count--disable">-</span>
                                            <input type="text" class="js-changeAmount count product-page-increment"
                                                   value="1"
                                                   readonly="">
                                            <span class="js_plus btn-count btn-count--plus">+</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="flex-row about-prod__btns-wrap">
                                    @switch((string) $product->availability)
                                        @case(ProductAvailability::NOT_AVAILABLE)
                                        <div class="not-avail">
                                            @auth('web')
                                                <a data-put="{{ route('ajax.user.put.in.waitinglist', [
                                                                'user_id' => auth('web')->id(),
                                                                'product' => $product, ]) }}"
                                                   data-method="POST"
                                                   data-inlist-message="@lang('frontend/profile/index.waitinglist_messages.exists')"
                                                   class="report
                                                   @if(auth('web')->user()->hasProductInWaiting($product)) active @endif
                                                    js_put_in_waitinglist">
                                                    @lang('frontend/product/index.notify_when_appears')
                                                </a>
                                            @else
                                                <a href="#" data-fancybox data-src="#modal" class="report">
                                                    @lang('frontend/product/index.notify_when_appears')
                                                </a>
                                            @endauth
                                        </div>
                                        @break
                                        @case(ProductAvailability::UNDER_ORDER)
                                        <div class="prod-cart__order" style="display: block;">
                                            <span class="ttl">
                                                    @lang('frontend/product/index.under_order')
                                            </span>
                                            <span class="discr">
                                                    @lang('frontend/product/index.delivery_date') - {{ $product->under_order_weeks }} @lang(trans_choice('frontend/product/index.weeks', $product->under_order_weeks))
                                            </span>
                                            <a data-href="{{ route('ajax.cart.add', $product) }}"
                                               style="display: block;" data-method="POST"
                                               class="js-add-to-cart prod-cart__buy" data-fancybox=""
                                               data-src="#modal-basket"
                                               data-category="{{ $product->getMainCategoryAttribute()->name }}"
                                               data-name="{{ $product->name }}"
                                               data-sku="{{ $product->sku }}"
                                               data-price="{{ $product->format_price }}"
                                               data-brand="{{ ShopHelper::setting("site_name") }}">
                                                @lang('frontend/product/index.to_order')
                                            </a>
                                        </div>
                                        @break
                                        @case(ProductAvailability::EXPECTED_DELIVERY)
                                            <div class="prod-cart__order" style="display: block;">
                                                <span class="ttl">
                                                        @lang('frontend/product/index.expected_delivery')
                                                </span>
                                                <span class="discr">
                                                        @lang('frontend/product/index.delivery_date') - @lang(trans_choice('frontend/product/index.expected_days', Carbon::now()->diffInDays($product->expected_at)+1))
                                                </span>
                                            </div>
                                        @default
                                        <div class="cols">
                                            @if($product->original_price > 0)
                                                <a data-href="{{ route('ajax.cart.add', $product) }}" data-method="POST"
                                                   class="js-add-to-cart main-btn main-btn--green" data-fancybox=""
                                                   data-src="#modal-basket"
                                                   data-category="{{ $product->getMainCategoryAttribute()->name }}"
                                                   data-name="{{ $product->name }}"
                                                   data-sku="{{ $product->sku }}"
                                                   data-price="{{ $product->format_price }}"
                                                   data-brand="{{ ShopHelper::setting("site_name") }}">
                                                    @lang('frontend/product/index.buy')
                                                </a>
                                                <a data-fancybox data-src="#modal-buy_per_click" href="#"
                                                   class="main-btn main-btn--orange btn-style_click">
                                                    @lang('frontend/product/index.consult_in_expert')
                                                </a>
                                            @else
                                                @include('frontend.elements.forms.temp_order')
                                                <a data-fancybox data-src="#modal-buy_per_click" href="#"
                                                   class="main-btn main-btn--orange btn-style_click">
                                                    @lang('frontend/product/index.consult_in_expert')
                                                </a>
                                            @endif
                                        </div>
                                    @endswitch
                                    <div class="cols">
                                        @include('frontend.elements.product.lists_buttons.compare_list_btn', ['classes' => [ 'mark' ]])
                                        @include('frontend.elements.product.lists_buttons.wishlist_btn', ['classes' => [ 'mark' ]])
                                    </div>
                                </div>
                                @if($product->technical_doc_url)
                                    <div class="flex-row">
                                        <a href="{{ $product->technical_doc_url }}" target="_blank" class="btn-download">
                                            <i class="icon icon-download"></i>
                                            @lang('frontend/product/index.download_technical_doc')
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if((int)ShopHelper::price_format($product->original_price))
                @include('frontend.elements.forms.temp_order')
            @endif
            <aside class="item-prod-right">
                @include('frontend.templates.product.includes.right_sidebar')
            </aside>
        </div>
    </div>
</section>
