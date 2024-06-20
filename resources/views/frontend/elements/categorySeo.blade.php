<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{ $page->name.$end_h1 }}",
      "image": "{{$og_meta['og_img']}}",
      "description": "{{$start_description . $seo_meta['seo_description']}}",
      "offers": {
        "@type": "AggregateOffer",
        "url": "{{$og_meta['og_url']}}",
        "priceCurrency": "UAH",
        "lowPrice": "{{$page->countAndPricesForSeoCategories['lowPrice']}}",
        "highPrice": "{{$page->countAndPricesForSeoCategories['highPrice']}}",
        "offerCount": "{{$page->countAndPricesForSeoCategories['offerCount']}}"
      },
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{$page->getRatingValue()}}",
        "bestRating": "5",
        "worstRating": "1",
        "ratingCount": "{{$page->getRatingCount()}}"
      }
    }
</script>