<div class="filter-nav js-filter-nav">
    <button class="close_filter js-close_filter">x</button>
    <form id="filters" action="" class="js_filters">
        <div class="filter-block">
            <div class="filter-wrapp header-filter">
                <p class="filter-title  js_open-filter">
                    <span class="icon icon-filter"></span>
                    <span class="filter-title__text">@lang('frontend/product/index.filters')</span>
                    @if($filtersCount)
                        {{ ($filtersCount) }}
                    @endif
                    <span class="symbol"></span>
                </p>
                <div class="filter__items">
                    <button class="main-btn apply-filter js_filters_accept">Применить</button>
                    @if($filtersCount)
                        <button class="button-reset btn-reset-filter js-reset-all-filters">@lang('frontend/product/index.filters_reset')</button>
                    @endif
                    <ul class="filter-list-selected">
                        @foreach($activeFilters as $filter)
                            @if($filter->filter_values->isNotEmpty())
                                @switch($filter->filter_type->file)
                                    @case(Filter::SLIDER)
                                        @if($filterHelper->getDefaultFilterValue($filter->alias, 'min') != $filterHelper->getCurrentFilterValue($filter->alias, 'min')
                                            || $filterHelper->getDefaultFilterValue($filter->alias, 'max') != $filterHelper->getCurrentFilterValue($filter->alias, 'max'))
                                            <li class="filter-item-selected">
                                                <span class="filter-selected-value">{{ $filter->name }}
                                                    @lang('frontend/product/index.from') {{ $filterHelper->getCurrentFilterValue($filter->alias, 'min') }}
                                                    @lang('frontend/product/index.to') {{ $filterHelper->getCurrentFilterValue($filter->alias, 'max') }}
                                                </span>
                                                <i class="icon icon-close js-uncheck-filter-value" data-type="{{ $filter->filter_type->file }}" data-id="slider{{ $filter->alias }}"> &#215;</i>
                                            </li>
                                        @endif
                                    @break
                                    @default
                                        @foreach($filter->filter_values->getCheckedValues() as $value)
                                            <li class="filter-item-selected">
                                                <span class="filter-selected-value">{{ $filter->name }} {{ $value->name }}</span>
                                                <i class="icon icon-close js-uncheck-filter-value" data-type="{{ $filter->filter_type->file }}" data-id="{{ $value->id }}"> &#215;</i>
                                            </li>
                                        @endforeach
                                @endswitch
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @if($filterHelper->getCurrentPrice('min') >= 0)
                <div class="filter-wrapp">
                    <p class="filter-title js_open-filter">
                        @lang('frontend/product/index.price_from') {{ $filterHelper->getCurrentPrice('min') }}
                        @lang('frontend/product/index.price_to') {{ $filterHelper->getCurrentPrice('max') }}
                        @lang('frontend/product/index.uah')
                        <span class="symbol"></span>
                    </p>
                    <div class="filter__items">
                        @include('frontend.elements.rangeSlider')
                    </div>
                </div>
            @endif
            <div class="filter-wrapp">
                <p class="filter-title js_open-filter">@lang('frontend/product/index.availability')
                    <span class="symbol"></span>
                </p>
                <div class="filter__items checkbox filter-item">
                    @foreach(ProductAvailability::getValues() as $key => $availability)
                        <div class="filter-area">
                            <input type="checkbox"
                                   name="availability"
                                   id="{{ $key }}"
                                   value="{{ $availability }}"
                                    {{ in_array($availability, $filterAvailability) ? 'checked' : '' }}>
                            <label for="{{ $key }}">
                                @switch($availability)
                                    @case(ProductAvailability::AVAILABLE)
                                        @lang('frontend/product/index.available')
                                        @break
                                    @case(ProductAvailability::NOT_AVAILABLE)
                                        @lang('frontend/product/index.out_of_stock')
                                        @break
                                    @case(ProductAvailability::UNDER_ORDER)
                                        @lang('frontend/product/index.under_order')
                                        @break
                                    @case(ProductAvailability::EXPECTED_DELIVERY)
                                        @lang('frontend/product/index.expected_delivery')
                                        @break
                                @endswitch
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach($filters as $filter)
                @if($filter->filter_values->isNotEmpty())
                    <div class="filter-wrapp">
                        <p class="filter-title js_open-filter">{{ $filter->name }}
                            <span class="symbol"></span>
                        </p>
                        <div class="filter__items checkbox filter-item">
                            @switch($filter->filter_type->file)
                                @case(Filter::SLIDER)
                                    <div class="form-group filter-group">
                                        <div class="row-m">
                                            <div class="range-text range-slider-row">
                                                <div class="form-group">
                                                    <input type="text" name="{{ $filter->alias }}[min]" value="{{ $filterHelper->getCurrentFilterValue($filter->alias, 'min') }}"
                                                           class="form-control form-control-min filter-url-ignore {{ $filter->alias }}-min"
                                                           data-slider-alias="{{ $filter->alias }}">
                                                </div>
                                                <i>&mdash;</i>
                                                <div class="form-group">
                                                    <input type="text" name="{{ $filter->alias }}[max]" value="{{ $filterHelper->getCurrentFilterValue($filter->alias, 'max') }}"
                                                           class="form-control form-control-max filter-url-ignore {{ $filter->alias }}-max"
                                                           data-slider-alias="{{ $filter->alias }}">
                                                </div>
                                                <button class="button-reset btn-approve-filter js_filters_accept">OK</button>
                                            </div>
                                            <div class="slider-range-h">
                                                <input type="text" name="{{ $filter->alias }}" id="slider{{ $filter->alias }}" class="span2"
                                                       data-slider-min="{{ $filterHelper->getDefaultFilterValue($filter->alias, 'min') }}"
                                                       data-slider-max="{{ $filterHelper->getDefaultFilterValue($filter->alias, 'max') }}"
                                                       data-slider-step="0.25"
                                                       data-slider-value="{{ $filterHelper->getFilterRangeForSlider($filter->alias) }}"
                                                       data-slider-orientation="horizontal"
                                                       data-value="{{ $filterHelper->getFilterRangeForSlider($filter->alias) }}"
                                                       value="{{ $filterHelper->getFilterRangeForSlider($filter->alias) }}"
                                                       data-slider-selection="after">
                                            </div>
                                        </div>
                                    </div>
                                @break
                                @default
                                    @foreach($filter->filter_values as $filterValue)
                                        <div class="filter-area">
                                            <a href="{{ $page->alias . '/' .  $filter->alias . '=' . $filterValue->alias}}">
                                                <input type="{{ $filter->filter_type->file }}"
                                                       name="{{ $filter->alias }}"
                                                       id="{{ $filterValue->id }}"
                                                       value="{{ $filterValue->alias }}"
                                                        {{ $filterValue->checked ? 'checked' : '' }}>
                                                <label for="{{ $filterValue->id }}">{{ $filterValue->name }}</label>
                                            </a>
                                        </div>
                                    @endforeach
                            @endswitch
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        {{ Form::hidden('sort', $sort) }}
        {{ Form::hidden('limit', $limit) }}
    </form>
</div>
