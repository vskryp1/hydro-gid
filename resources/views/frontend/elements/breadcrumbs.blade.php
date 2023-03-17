@isset($breadcrumbs)
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
            @foreach($breadcrumbs as $key => $breadcrumb)
                @if($loop->first)
                    {
                        "@type": "ListItem",
                        "position": 1,
                        "item": {
                            "@id": "{{ $breadcrumb['url'] }}",
                            "name": "{{ $breadcrumb['name'] }}"
                        }
                    },
                @else
                    @if($loop->last)
                        {
                            "@type": "ListItem",
                            "position": {{ $key + 1 }},
                            "item": {
                                "@id": "{{ $breadcrumb['url'] }}",
                                "name": "{{ $breadcrumb['name'] }}"
                            }
                        }
                    @else
                        {
                            "@type": "ListItem",
                            "position": {{ $key + 1 }},
                            "item": {
                                "@id": "{{ $breadcrumb['url'] }}",
                                "name": "{{ $breadcrumb['name'] }}"
                            }
                        },
                    @endif
                @endif
            @endforeach
            ]
        }
    </script>
    <div class="breadcrumb">
        <ul class="breadcrumb-list">
            @foreach($breadcrumbs as $breadcrumb)
                @if($loop->first)
                    <li>
                        <a href="{{ $breadcrumb['url'] }}">
                            <i class="icon icon-home"></i>
                        </a>
                    </li>
                @else
                    @if($loop->last)
                        <li class="active">
                            <span>
                                {{ $breadcrumb['name'] }}
                            </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $breadcrumb['url'] }}">
                                {{ $breadcrumb['name'] }}
                            </a>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </div>
@endisset