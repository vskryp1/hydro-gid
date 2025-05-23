<script type="application/ld+json">
    {
      "@context": "https://schema.org/",
      "@type": "Product",
      "name": "{{ $product->name }}",
      "image": [
@if(isset($product->images) && count($product->images) > 0)
@php $i = 0; @endphp
@foreach($product->images as $image)
@php if($i == 2) break; @endphp
@if(count($product->images) > 1 && $i < 1)
        "{{$image->getUrl('prod_sm')}}",
@else
        "{{$image->getUrl('prod_sm')}}"
@endif
@php $i++; @endphp
@endforeach
@else
        "{{ $product->cover->getUrl('prod_sm') }}",
@endif
       ],
      "description": "{{ $seo_meta['seo_description'] }}",
      "sku": "{{ $product->sku }}",
      "mpn": "{{ $product->sku }}",
      "brand": {
        "@type": "Brand",
        "name": "{{ ShopHelper::setting("site_name") }}"
      },
@if($product->reviews()->count() && ($review = $product->productReviewsLastSeo()) )
      "review": {
        "@type": "Review",
        "reviewRating": {
          "@type": "Rating",
          "ratingValue": "{{$review->rating}}",
          "bestRating": "5"
        },
        "author": {
          "@type": "Person",
          "name": "{{$review->username}}"
        }
      },
@endif
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $product->product_reviews->isEmpty() ? $product->rating : round($product->product_reviews->average('rating')) }}",
        "reviewCount": "{{ $product->reviews()->count() ? $product->reviews()->count() : 1 }}"
      },
      "offers": {
        "@type": "Offer",
        "url": "{{ url()->current() }}",
        "priceCurrency": "UAH",
        "price": "{{ $product->format_price }}",
        "priceValidUntil": "{{date('Y', time()) .'-12-31'}}",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock"
      }
    }
</script>
