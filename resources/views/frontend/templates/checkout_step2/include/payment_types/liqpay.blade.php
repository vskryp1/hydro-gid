<div id="liqpay_checkout"></div>
<script>
    window.LiqPayCheckoutCallback = function() {
        LiqPayCheckout.init({
            data: "{!! $data !!}",
            signature: "{!! $signature !!}",
            embedTo: "#liqpay_checkout",
            language: "{!! $language !!}",
            mode: "embed" // embed || popup
        }).on("liqpay.callback", function(data){
            console.log("liqpay.callback");
            console.log(data.status);
            console.log(data);
        }).on("liqpay.ready", function(data){
            console.log("liqpay.ready");
            console.log(data);
        }).on("liqpay.close", function(data){
            console.log('liqpay.close');
            console.log(data);
        });
    };
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
</script>
<script src="//static.liqpay.ua/libjs/checkout.js" async></script>