<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Store",
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "{{ $schema_org['localBusiness']['location'] }}",
        "addressRegion": "{{ $schema_org['localBusiness']['foundingLocation'] }}",
        "postalCode":"{{ $schema_org['localBusiness']['leiCode'] }}",
        "streetAddress": "{{ $schema_org['localBusiness']['address'] }}"
    },
    "description": "{{ $schema_org['localBusiness']['description'] }}",
    "name": "{{ $schema_org['localBusiness']['name'] }}",
    "telephone": "{{ $schema_org['localBusiness']['telephone'] }}",
    "openingHours":
        [
            @foreach($schema_org['localBusiness']['openingHours'] as $item)
                "{{ $item['full_day'] }} {{ $item['time'] }}"{{ $loop->last ? '' : ',' }}
            @endforeach
        ],
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{ $schema_org['localBusiness']['latitude'] }}",
        "longitude": "{{ $schema_org['localBusiness']['longitude'] }}"
     },
    "priceRange": "UAH",
    "image": "{{ $schema_org['localBusiness']['image'] }}",
    "sameAs" :
        [
            @foreach($schema_org['localBusiness']['sameAs'] as $item)
                "{{ $item }}"{{ $loop->last ? '' : ',' }}
            @endforeach
        ]
}
</script>