@foreach($articles as $article)
    <div class="blog__item">
        <a href="{{ $article->alias }}">
            <div class="blog__item-img">
                <picture>
                    <source type="image/webp" srcset="{{ $article->getImageUrl('page_blog', 'image', true) }}">
                    <img src="{{ $article->getImageUrl('page_blog') }}"
                         alt="{{ $article->name }}"
                         title="{{ $article->name }}">
                </picture>
            </div>
            <div class="blog__item-title">
                {{ $article->name }}
            </div>
            <div class="blog__item-date">
                <span class="icon icon-calendar"></span>
                {{ $article->updated_at->translatedFormat('j F Y') }}
            </div>
        </a>
    </div>
@endforeach
