<div class="modal__content">
    <div class="modal__content-scroll">
        @foreach(CartHelper::content() as $item)
            <div class="checkout__aside-item">
                <img class="checkout__aside-img"
                     src="{{ $item->model->cover->getUrl('prod_cart') }}"
                     alt="{{  $item->model->cover->alt }}">
                <div class="checkout__aside-info">
                    <div class="checkout__aside-text">
                        {{  $item->model->name }}
                        {{ $item->getWarrantyText() }}
                    </div>
                    <div class="checkout__aside-number">
                        <div class="checkout__aside-prise">
                            <span>
                                {{ $item->getFormattedSumPriceByPosition() }}
                                {{ __('frontend/checkout/index.uan') }}
                            </span>
                        </div>
                        <div class="checkout__aside-sum">
                            <small>
                            {{ $item->qty }}  @lang('frontend/checkout/index.qty')
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="checkout__aside-text-total">
        @include('frontend.templates.checkout_step1.include.discount_block')
        @lang('frontend/checkout/index.total')
        <span class="checkout-aside-total">
            {{ CartHelper::totalProductsPriceFormatted(true) }}  @lang('frontend/checkout/index.uan')
        </span>
    </div>
</div>
