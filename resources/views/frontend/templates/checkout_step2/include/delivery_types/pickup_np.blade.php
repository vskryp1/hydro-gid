<div class="js-delivery-type checkout__radio-box {{ $class }}">
    <div class="form-group">
        <div class="checkout__radio-title">
            {{ $delivery->name }}
        </div>
        <div class="checkout__radio-adress">
            {{ Form::select(
            'place_api_id',
            [],
            null,
            ['class' => 'delivery-select form-control', 'data-url' => route('ajax.cart.nova_poshta_warehouses', ['city' => null])]
            ) }}
        </div>
    </div>
    <div class="form-group">
        <div class="checkout__radio-adress warehouses-block">
            {{ Form::select('warehouse_id', [], null, [
                'class' => 'required form-control warehouses',
                'required'
            ])}}
        </div>
    </div>
    <a href="#" data-fancybox data-clickSlide="false" data-touch="false" data-src="#map-{{ $delivery->id }}">
        @lang('frontend/checkout/index.watch_on_map')
        <span class="icon icon-map"></span>
    </a>
    <div class="map" id="map-{{ $delivery->id }}"></div>
</div>
