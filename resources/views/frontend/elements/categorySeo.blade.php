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
        "lowPrice": "{{($page->getLowPrice()->format_price == 0) ? 1 : $page->getLowPrice()->format_price }}",
        "highPrice": "{{$page->getHighPrice()->format_price}}",
        "offerCount": "{{$page->getOfferCount()}}"
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