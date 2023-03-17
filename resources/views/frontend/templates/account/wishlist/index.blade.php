<div class="wish-list personal__tab-content">
    <div class="personal__tab-title">
        {{ __('frontend/profile/index.wishlist') }}
    </div>
    @isset($data['wishlist'])
        @if($data['wishlist']->count() > 0)
            <div class="category-product js_height-block">
                <div class="row">
                    @foreach($data['wishlist'] as $product)
                        @include('frontend.templates.account.wishlist.product', [
                            'product' => $product->model,
                            'rowId'   => $product->rowId,
                        ])
                    @endforeach
                </div>
            </div>
        @else
            {{ __('frontend.nothing_found') }}
        @endif
    @endisset
</div>
