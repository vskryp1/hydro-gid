<ul class="filter__items checkbox filter-item">
    <li>
        <a href="#" class="active">@lang('frontend/content/index.items')
            <span>({{ $products_count }})</span>
        </a>
    </li>

    @foreach($products_by_categories as $item)
        <li>
            <div class="filter-area">
                <input type="checkbox"
                       name="category"
                       id="{{ $item['page']->id }}"
                       value="{{ $item['page']->position }}">
                <label for="{{ $item['page']->id }}">{{ $item['page']->name }}</label>
                <span class="search-qw">({{ count($item['products']) }})</span>
            </div>
        </li>
    @endforeach
</ul>