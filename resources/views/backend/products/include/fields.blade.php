<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories"
               data-tab="#categories" role="tab"
               aria-controls="home" aria-selected="false">
                @lang('backend.categories') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" data-tab="#locale"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.locale') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" data-tab="#seo"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.seo') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="filters-tab" data-toggle="tab" href="#filters" data-tab="#filters"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.filters') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" data-tab="#gallery"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.gallery') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#video" data-tab="#video"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.video') </a>
        </li>
        @if(config('app.group_products', false))
            <li class="nav-item">
                <a class="nav-link" id="group-tab" data-toggle="tab" href="#group" data-tab="#group"
                   role="tab"
                   aria-controls="group" aria-selected="false">
                    @lang('backend.group_product')
                    @if(isset($product) && $product->all_group->count() > 1)
                        <span class="badge badge-success">{{$product->all_group->count()}}</span>
                    @endif
                </a>

            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" id="warranty-tab" data-toggle="tab" href="#warranty" data-tab="#warranty"
               role="tab"
               aria-controls="group" aria-selected="false">
                @lang('backend/product/index.warranty')
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="root-tab tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.alias')</label>
                            <small class="form-text text-muted">@lang('backend.must_unique')</small>
                            <div class="input-group">
                                <span class="input-group-addon" id="addon-url">{{url('/')}}/</span>
                                {!! Form::text('alias', old('alias', (isset($product) ? $product->getOriginal('alias') : null)), ['class'=>'form-control','placeholder'=>__('backend.alias'), "aria-describedby"=>"addon-url" ]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.sku')</label>
                            <small class="form-text text-muted">@lang('backend.must_unique')</small>
                            {!! Form::text('sku', null, ['class'=>'form-control','placeholder'=>__('backend.sku'), 'required' ]) !!}
                        </div>

                        <div class="form-group">
                            <label>@lang('backend.position')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'position', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::number('position', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.price')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'original_price', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::number(
                                     'original_price_old',
                                      old('original_price_old')??(isset($product)?round($product->original_price_old, 2):0),
                                     ['class'=>'form-control','placeholder'=> __('backend.price'),'required', 'step'=>0.01,'min'=>0.1]
                              ) !!}
                            @if(isset($product) && $product->inStock())
                                <span>@lang('backend/product/index.product_in_stock'){{ $product->original_price }}</span>
                                @foreach($product->stock as $stock)
                                    <div>
                                        <a href="{{ route('backend.stocks.edit', $stock) }}">
                                            {{ $stock->name }}
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.rating')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'rating', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::number('rating',null,['class'=>'form-control', 'required', 'step' => 1, 'min' => 0, 'max' => 5]) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('rating_calculate', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.rating_calculate')
                            @if(config('app.group_products', false))
                                <div class="pull-right">
                                    <label>
                                        <small class="form-text text-muted"
                                               style="font-weight: 700;">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'rating_calculate', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            <br>
                            <br>
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.currency')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'currency_id', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::select('currency_id', $currencies_list??['-'], null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.status')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[product_status_id]', 'position', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::select('product_status_id',
                                $product_statuses??['-'],
                                null,
                                [
                                 'class'=>'form-control',
                                 'placeholder' => __('backend/product/index.product_status_null'),
                                  (isset($product) && $product->inStock() ? 'disabled' : '')
                                ]
                            ) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.availability')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[availability]', 'position', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::select('availability', ProductAvailability::toSelectArray(), null, ['id' => 'availability', 'class'=>'form-control', '']) !!}
                        </div>
                            <div class="form-group" id='under_order_weeks'
                                 style="display: {{ isset($product) && $product->availability->value == App\Enums\ProductAvailability::UNDER_ORDER
                                                    ? 'block'
                                                    : 'none' }} "
                                 data-product-availability="{{ App\Enums\ProductAvailability::UNDER_ORDER }}">
                                <label for="position">@lang('backend.under_order_weeks')</label><br>
                                {!! Form::number('under_order_weeks', null, ['class' => 'form-control']) !!}
                            </div>
                        <div class="form-group">
                            <label>@lang('backend/product/index.expected_at')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[expected_at]', 'position', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::date('expected_at', null, ['class'=>'form-control', '']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.sale_type')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[sale_type]', 'position', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::select('sale_type', ProductSaleType::toSelectArray(), null, ['class'=>'form-control', '']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.buy_also')</label>
                            {!! Form::select('relations[]', isset($product) ? $product->productRelations->pluck('name', 'id') : [], isset($product) ? $product->productRelations->pluck('id') : null, ['class' => 'form-control js_parent_search has-feedback-left', 'multiple' => true])!!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend/product/index.similar_products')</label>
                            {!! Form::select('similar[]', isset($product) ? $product->similarProducts->pluck('name', 'id') : [], isset($product) ? $product->similarProducts->pluck('id') : null, ['class' => 'form-control js_parent_search has-feedback-left', 'multiple' => true])!!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend/product/index.upload_technical_doc')</label>
                            @isset($product->technical_doc_url)
                                <div class="row tech-doc">
                                    <div class="col-md-6">
                                        <a href="{{ $product->technical_doc_url }}" target="_blank">@lang('backend/product/index.download_pdf')</a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a class="btn btn-danger btn-xs" data-tech-doc style="margin-bottom: 6px;" title="Удалить">@lang('backend/product/index.delete_pdf')</a>
                                    </div>
                                </div>
                            @endisset
                            @isset($product)
                                <input class="form-control" id="technical_doc" name="technical_doc_name" value="{{ $product->technical_doc }}" type="hidden">
                            @endisset
                            {!! Form::file('technical_doc', ['class' => 'form-control'])!!}
                            @if(config('app.group_products', false))
                                <div class="pull-right">
                                    <label>
                                        <small class="form-text text-muted"
                                               style="font-weight: 700;">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[technical_doc]', 'active', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
                            @if(config('app.group_products', false))
                                <div class="pull-right">
                                    <label>
                                        <small class="form-text text-muted"
                                               style="font-weight: 700;">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'active', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('allow_default_warranty', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.allow_default_warranty')
                            @if(config('app.group_products', false))
                                <div class="pull-right">
                                    <label>
                                        <small class="form-text text-muted"
                                               style="font-weight: 700;">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'allow_default_warranty', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="categories" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.categories')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'categories', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::select('categories[]', $categories, $product_categories??[], ['class'=>'form-control1 select2 js_categories', 'value' => old('page_product_id'), 'multiple' => "multiple"]) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.main_category')</label>
                            <div class="js_main_category"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <br>
            <div class="row tabs-vertical-env tabs-vertical-bordered">

                <ul class="nav tabs-vertical" id="locales-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class=" @if ($loop->first) active @endif">
                            <a class="nav-link"
                                 id="locale-{{ $lang }}-tab"
                                 data-toggle="pill"
                                 href="#locales-{{ $lang }}"
                                 role="tab"
                                 aria-controls="locales-{{ $lang }}"
                                 aria-selected="true">{{ strtoupper($lang) }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="locales-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if ($loop->first)in active @endif"
                             id="locales-{{ $lang }}" role="tabpanel"
                             aria-labelledby="locales-{{ $lang }}-tab">
                            <div class="form-group">
                                <label>@lang('backend.name') <span class="required">*</span></label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'name', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[name]', isset($product) ? $product->translate($lang)->name : '',['class'=>'form-control', 'required']) !!}
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label>@lang('backend.introtext')</label>--}}
{{--                                @if(config('app.group_products', false))--}}
{{--                                    <div class=" pull-right">--}}
{{--                                        <label>--}}
{{--                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>--}}
{{--                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'introtext', null, ['class' => 'js-switch']) !!}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                                {!! Form::textarea( $lang . '[introtext]', $product->{'introtext:'.$lang}??'',['class'=>'form-control ck-editor', 'rows' => 3]) !!}--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label>@lang('backend.description')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'description', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::textarea( $lang . '[description]', isset($product) ? $product->translate($lang)->description : '',['class'=>'form-control ck-editor']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="seo" role="tabpanel" aria-labelledby="home-tab">
            <br>
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="seo-locales-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class=" @if ($loop->first) active @endif"><a class="nav-link"
                                                                         id="seo-locales-{{ $lang }}-tab"
                                                                         data-toggle="pill"
                                                                         href="#seo-locales-{{ $lang }}"
                                                                         role="tab"
                                                                         aria-controls="seo-locales-{{ $lang }}"
                                                                         aria-selected="true">{{ strtoupper($lang) }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="seo-locales-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if ($loop->first)in active @endif"
                             id="seo-locales-{{ $lang }}" role="tabpanel"
                             aria-labelledby="seo-locales-{{ $lang }}-tab">
                            <div class="form-group">
                                <label>@lang('backend.seo_title')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_title', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[seo_title]', isset($product) ? $product->translate($lang)->seo_title : '',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_keywords')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_keywords', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[seo_keywords]', isset($product) ? $product->translate($lang)->seo_keywords : '',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_description')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_description', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[seo_description]', isset($product) ? $product->translate($lang)->seo_description : '',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_canonical')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_canonical', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[seo_canonical]', isset($product) ? $product->translate($lang)->seo_canonical : '',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_robots')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_robots', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::text( $lang . '[seo_robots]', isset($product) ? $product->translate($lang)->seo_robots : '',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_content')</label>
                                @if(config('app.group_products', false))
                                    <div class=" pull-right">
                                        <label>
                                            <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                            {!! Form::checkbox('fields_group['.$lang.'][]', 'seo_content', null, ['class' => 'js-switch']) !!}
                                        </label>
                                    </div>
                                @endif
                                {!! Form::textarea( $lang . '[seo_content]', isset($product) ? $product->translate($lang)->seo_content : '',['class'=>'form-control ck-editor']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="filters" role="tabpanel" aria-labelledby="home-tab">
            @if(config('app.group_products', false))
                <div class=" pull-right">
                    <label>
                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                        {!! Form::checkbox('fields_group[]', 'filters', null, ['class' => 'js-switch']) !!}
                    </label>
                </div>
            @endif
            <h4>@lang('backend.filters')</h4>
            <div class="js_filters"></div>
        </div>
        <div class="root-tab tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="home-tab">
            @if(config('app.group_products', false))
                <div class=" pull-right">
                    <label>
                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                        {!! Form::checkbox('fields_group[]', 'images', null, ['class' => 'js-switch']) !!}
                    </label>
                </div>
            @endif
            <h4>@lang('backend.gallery')</h4>
            <div class="row">
                <div class="dropzone-wrapper" id="gallery_wrapper">
                    @isset($product)
                        @foreach($product->images as $image)
                            @include("backend.products.include.galleryItem", ['image' => $image])
                        @endforeach
                    @endisset
                </div>
            </div>
            <div class="row text-center">
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#upload-image-modal"><i class="fa fa-upload"></i> @lang('backend.images_upload')
                </button>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="video" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.video_youtube')</label>
                            @if(config('app.group_products', false))
                                <div class=" pull-right">
                                    <label>
                                        <small class="form-text text-muted">@lang('backend.apply_to_group')</small>
                                        {!! Form::checkbox('fields_group[]', 'video', null, ['class' => 'js-switch']) !!}
                                    </label>
                                </div>
                            @endif
                            {!! Form::text('video', null, ['class'=>'form-control']) !!}

                        </div>
                        @if(isset($product))
                            <div class="form-group">
                                {!! $product->video !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(config('app.group_products', false))
            <div class="root-tab tab-pane fade" id="group" role="tabpanel"
                 aria-labelledby="group-tab">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @if(!isset($product) || !$product->children->count())
                            <div class="form-group">
                                <label>@lang('backend.modification_from')</label>
                                {!! Form::select(
                                    'parent_id',
                                    isset($product->parent) && $product->parent_id != $product->id
                                    ? [$product->parent->id => $product->parent->full_name]
                                    :
                                    [],
                                    null,
                                    [
                                        'class' => 'form-control js_parent_search has-feedback-left',
                                    ]
                               )!!}
                            </div>
                        @else
                            <div class="form-group text-center">
                                <label>@lang('backend.this_is_parent')</label>
                            </div>
                        @endif
                        <div class="row text-center">
                            @isset($product)
                                <a data-dialog="@lang('backend.need_to_save_data')" data-do="link"
                                   href="{{route('backend.products.group.edit', $product->id)}}"
                                   class="btn btn-sm btn-primary text-uppercase js_manage_group_btn">
                                    <i class="fa fa-cubes"></i> <span>@lang('backend.manage_product_group')</span>
                                </a>
                            @else
                                <a disabled="disabled" class="btn btn-sm btn-primary text-uppercase">
                                    <i class="fa fa-cubes"></i> <span>@lang('backend.save_to_manage_group')</span>
                                </a>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="root-tab tab-pane fade" id="warranty" role="tabpanel"
             aria-labelledby="warranty-tab">
            <div class="row">
                <div class="col-md-12">
                    @if(isset($product))
                        @include('backend.products.include.warranty')
                    @else
                        <div class="panel panel-default user-panel panel-flat">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div class="form-group">
                                            <label for="amount">@lang('backend/product/index.amount_of_time')</label><br>
                                            {!! Form::number(
                                                'warranties[amount]',
                                                isset($warranty) ? $warranty->amount : null,
                                                ['id' => 'amount', 'class' => 'form-control']
                                            ) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="price">@lang('backend.price')</label><br>
                                            {!! Form::number('warranties[price]', null, ['id' => 'price', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="position">@lang('backend.position')</label><br>
                                            {!! Form::number('warranties[position]', null, ['id' => 'position', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="position">@lang('backend.active')</label><br>
                                            {!! Form::hidden('warranties[active]', 0) !!}
                                            {!! Form::checkbox('warranties[active]', 1, null, ['id' => 'position', 'class' => 'js-switch']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.products.index'),
    'show_link' => (isset($product) ? $product->alias : null) ,
    'copy_link' => (isset($product) ? route('backend.products.copy', $product) : null),
])