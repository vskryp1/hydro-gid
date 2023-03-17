<url>
    <loc>{{ LaravelLocalization::getLocalizedURL($lang, $page->getOriginal('alias')) }}</loc>
    @switch(class_basename($model))
        @case(Page::class)
            <image:image>
                <image:loc>{{ $page->image }}</image:loc>
            </image:image>
            @break
        @case(Product::class)
            @foreach($page->images as $image)
                <image:image>
                    <image:loc>{{ asset($image->image)}}</image:loc>
                </image:image>
            @endforeach
            @break
        @case(Slider::class)
            @foreach($page->slider_items as $image)
                <image:image>
                    <image:loc>{{ $image->getUrl() }}</image:loc>
                </image:image>
            @endforeach
            @break
    @endswitch
</url>