@forelse($stocks as $stock)
    <div class="stock__item">
        <div class="stock__item-img">
            <picture>
                <source type="image/webp" srcset="{{ $stock->getImageUrl('stocks', true) }}">
                <img src="{{ $stock->getImageUrl() }}"
                     alt="{{ $page->name }}"
                     title="{{ $page->name }}"/>
            </picture>
        </div>
        <div class="stock__item-content">
            <div class="stock__item-title">
                {{ $stock->name }}
            </div>
            <div class="stock__item-info">
                <span class="icon-time icon"></span>
                @lang('frontend/stock/index.stocks_is_active_from')
                {{ $stock->start_date->translatedFormat('j F Y') }}
                @lang('frontend/stock/index.till')
                {{ $stock->expiration_date->translatedFormat('j F Y')}}
            </div>
            <div class="stock__item-text">
                {{ Str::limit($stock->description, 150) }}
            </div>
            <div class="stock__item-btn">
                <a href="{{ route('frontend.stock', $stock) }}">@lang('frontend/stock/index.details')</a>
            </div>
        </div>
    </div>
@empty
    @lang('frontend.nothing_found')
@endforelse