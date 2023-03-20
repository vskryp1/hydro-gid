<script>
    dataLayer = [{
        'transactionId': '{{ session()->get("order_id") }}',
        'transactionAffiliation': '{{ ShopHelper::setting("site_name") }}',
        'transactionTotal': '{{ session()->get("total_price") }}',
        'transactionProducts': [
            @foreach(session()->get('order_products') as $item)
            {
                'name': '{{ $item["name"] }}',
                'sku': '{{ $item["sku"] }}',
                'price': '{{ $item["price"] }}',
                'category': '{{ $item["category"] }}',
                'quantity': '{{ $item["qty"] }}'
            }@unless($loop->last),@endif
            @endforeach
        ],
        'event': 'trackTrans'
    }];
</script>
