@if (Session::has('one_click_order'))
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'transactionId': {{ session()->get('one_click_order')['transaction'] }},
            'transactionTotal': {{ session()->get('one_click_order')['price'] }},
            'transactionProducts': [{
                'sku': {{ session()->get('one_click_order')['sku'] }},
                'name': {{ session()->get('one_click_order')['name'] }},
                'category': {{ session()->get('one_click_order')['category'] }},
                'price': {{ session()->get('one_click_order')['price'] }},
                'quantity': 1
            }],
            'event': 'trackTrans'
        });
    </script>
    {{ session()->forget('one_click_order') }}
@endif