<div class="js-delivery-type checkout__radio-box {{ $class }}">
    <div class="checkout__radio-title">
        {{ $delivery->name }}
    </div>
    <div class="checkout__radio-adress putOn">
        <span>{{ ShopHelper::setting('pickup_address') }}</span>
        <a href="#" data-fancybox data-clickSlide="false" data-touch="false" data-src="#map-{{ $delivery->id }}">
            <span>@lang('frontend/checkout/index.watch_on_map')</span>
            <span class="icon icon-map"></span>
        </a>
    </div>
    <div class="map" id="map-{{ $delivery->id }}"></div>
</div>
<script>
    window.hydrogidGeo   = {!! json_encode(Setting::get('site_geo')) !!};
    window.hydrogidTitle = '{!! Setting::get('site_name', 'Гидро Гид') !!}';
</script>