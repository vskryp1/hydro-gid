<form method="POST" id="privatPay" action="https://api.privatbank.ua/p24api/ishop" hidden>
    <input type="hidden" name="amt" value="{{ $totalPrice }}"/>
    <input type="hidden" name="ccy" value="UAH"/>
    <input type="hidden" name="merchant" value="{{ config('app.pb24_merchant_id') }}"/>
    <input type="hidden" name="order" value="{{ $unique_id }}"/>
    <input type="hidden" name="details" value="{{ $unique_id }}"/>
    <input type="hidden" name="ext_details" value="{{ $ext_details }}"/>
    <input type="hidden" name="return_url" value="{{ route('frontend.callback.privat') }}"/>
    <input type="hidden" name="server_url" value="{{ route('frontend.page') }}"/>
    <input type="hidden" name="pay_way" value="privat24"/>
    <button type="submit">Оплата Privat24</button>
</form>
<script>
    window.dataLayer = window.dataLayer || [];
    dataLayer.push({
        'ecommerce': {
            'currencyCode': 'UAH',
            'purchase': {
                'actionField': {
                    'id': '{{ session()->get('order_id') }}',
                    'revenue' : '{{ session()->get('total_price') }}'
                },
                'products': [
                        @foreach(session()->get('order_products') as $item)
                    {
                        'name': '{{ $item["name"] }}',
                        'id': '{{ $item["sku"] }}',
                        'price': '{{ $item["price"] }}',
                        'brand': '{{ ShopHelper::setting("site_name") }}',
                        'category': '{{ $item["category"] }}'
                    }@unless($loop->last),@endif
                    @endforeach
                ]
            }
        },
        'event': 'gtmUaEvent',
        'gtmUaEventCategory': 'Enhanced Ecommerce',
        'gtmUaEventAction': 'Purchase',
        'gtmUaEventNonInteraction': 'True'
    });
    window.sessionStorage.setItem('is_send_ecomerce', true);
    document.getElementById('privatPay').submit();
</script>