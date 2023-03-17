<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "Product",
    "url": "{{ url()->current() }}",
    "category": "{{ $product->getMainCategoryAttribute()->name }}",
    "image": "{{ $product->cover->getUrl('prod_sm') }}",
    "brand": "{{ ShopHelper::setting('site_name') }}",
    "name": "{{ $product->name }}",
    "description": "{{ $product->description ?? $seo_meta['seo_description'] }}",
    "offers": {
        "@type": "Offer",
        "availability": "@switch((string) $product->availability)
            @case(ProductAvailability::NOT_AVAILABLE)
                OutOfStock
            @break
            @case(ProductAvailability::UNDER_ORDER)
                PreOrder
            @break
            @case(ProductAvailability::EXPECTED_DELIVERY)
                PreOrder
            @default
                @if($product->original_price > 0)
                    InStock
                @else
                    PreOrder
                @endif
            @endswitch",
        "price": "{{ $product->price }}",
        "priceCurrency": "{{ $product->currency()->first()->name }}",
        "url": "{{ url()->current() }}"
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $product->product_reviews->isEmpty() ? $product->rating : round($product->product_reviews->average('rating')) }}",
        "reviewCount": "{{ $product->reviews()->count() ? $product->reviews()->count() : 1 }}"
    }
}
</script>