<div class="form-group filter-group">
    <div class="row-m">
        <div class="range-text range-slider-row">
            <div class="form-group">
                <input type="text" name="price[min]" value="{{ $filterHelper->getCurrentPrice('min') }}"
                       class="form-control form-control-min filter-url-ignore price-min"
                       data-slider-alias="price">
            </div>
            <i>&mdash;</i>
            <div class="form-group">
                <input type="text" name="price[max]" value="{{ $filterHelper->getCurrentPrice('max') }}"
                       class="form-control form-control-max filter-url-ignore price-max"
                       data-slider-alias="price">
            </div>
                <button class="button-reset btn-approve-filter js_filters_accept">OK</button>
        </div>
        <div class="slider-range-h">
            <input type="text" name="price" id="sliderprice" class="span2"
                   data-slider-min="{{ $filterHelper->getDefaultPriceValue('min') }}"
                   data-slider-max="{{ $filterHelper->getDefaultPriceValue('max') }}"
                   data-slider-step="1"
                   data-slider-value="{{ $filterHelper->getPriceRangeForSlider() }}"
                   data-slider-orientation="horizontal"
                   data-value="{{ $filterHelper->getPriceRangeForSlider() }}"
                   value="{{ $filterHelper->getPriceRangeForSlider() }}"
                   data-slider-selection="after">
        </div>
    </div>
</div>
