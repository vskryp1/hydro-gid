<div class="waiting-list personal__tab-content">
    <div class="personal__tab-title">
        {{ __('frontend/profile/index.waitinglist') }}
    </div>
    @isset($data['waitinglist'])
        @if($data['waitinglist']->count())
            <div class="row category-product js_height-block">
                @foreach($data['waitinglist'] as $product)
                    @include('frontend.templates.account.waitinglist.product', [
                        'product' => $product->model,
                        'rowId'   => $product->rowId,
                    ])
                @endforeach
            </div>
        @else
            {{ __('frontend.nothing_found') }}
        @endif
    @endisset
</div>