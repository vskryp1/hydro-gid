<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab" aria-controls="home" aria-selected="true">
                @lang('backend.base')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" data-tab="#locale" role="tab" aria-controls="profile" aria-selected="false">
                @lang('backend.locale')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" data-tab="#seo" role="tab" aria-controls="profile" aria-selected="false">
                @lang('backend.seo')
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="root-tab tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        @isset($stock)
                            <img src="{{ $stock->getImageUrl() }}" width="50%">
                        @endisset
                        <br/>
                        <label for="image">@lang('backend/stocks/index.image')</label><br>
                        {!! Form::file('uploaded_image', ['id' => 'image', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="products">
                            @lang('backend.category')
                        </label>
                        {!! Form::select('page_id', $categories, isset($stock) ? $stock->page_id : null, ['id' => 'products', 'class' => 'select2 form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="products">
                            @lang('backend/stocks/index.products')
                            <span class="required">*</span>
                        </label>
                        {!! Form::select('products[]', $products, null, ['id' => 'products', 'class' => 'select2 form-control', 'multiple' => true]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputDiscount" class="control-label">
                            @lang('backend/profile/index.discount')
                            <span class="text text-danger">*</span>
                        </label>
                        {!! Form::number('discount', null, [
                            'id'           => 'inputDiscount',
                            'class'        => 'form-control',
                            'autocomplete' => 'off',
                            'min'          => 0,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputIsPercentage" class="control-label">
                            @lang('backend/profile/index.is_percentage')
                        </label><br>
                        {!! Form::hidden('is_percentage', 0) !!}
                        {!! Form::checkbox('is_percentage', 1, null, [
                            'id'    => 'inputIsPercentage',
                            'class' => 'js-switch',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="start_date">
                            @lang('backend/stocks/index.start_date')
                            <span class="required">*</span>
                        </label>
                        {!! Form::date('start_date', isset($stock) ? $stock->start_date : null, ['id' => 'start_date', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="expire_date">
                            @lang('backend/stocks/index.expire_date')
                            <span class="required">*</span>
                        </label>
                        {!! Form::date('expiration_date', isset($stock) ? $stock->expiration_date : null, ['id' => 'expire_date', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="position">
                            @lang('backend.position')
                            <span class="required">*</span>
                        </label>
                        {!! Form::number('position', null, ['id' => 'position', 'class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="active">@lang('backend/stocks/index.active')</label><br>
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, null, ['id' => 'active', 'class' => 'js-switch']) !!}
                    </div>
                    <div class="form-group">
                        <label for="is_main">@lang('backend/stocks/index.is_main')</label><br>
                        {!! Form::hidden('is_main', 0) !!}
                        {!! Form::checkbox('is_main', 1, null, ['id' => 'is_main', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="locales-tab" role="tablist" aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class="@if($loop->first) active @endif">
                            <a class="nav-link" id="locale-{{ $lang }}-tab" data-toggle="pill" href="#locales-{{ $lang }}" role="tab" aria-controls="locales-{{ $lang }}" aria-selected="true">
                                {{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="locales-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if($loop->first) in active @endif" id="locales-{{ $lang }}" role="tabpanel" aria-labelledby="locales-{{ $lang }}-tab">
                            <div class="form-group">
                                <label for="name">
                                    @lang('backend/stocks/index.name')
                                    <span class="required">*</span>
                                </label>
                                {!! Form::text($lang . '[name]', isset($stock) ? $stock->{'name:' . $lang} : null, ['id' => 'name' . $lang, 'class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="description">
                                    @lang('backend/stocks/index.description')
                                </label>
                                {!! Form::textarea($lang . '[description]', isset($stock) ? $stock->{'description:' . $lang} : null, ['id' => 'description' . $lang, 'class' => 'form-control', 'rows' => 3]) !!}
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
                        <li class=" @if ($loop->first) active @endif">
                            <a class="nav-link" id="seo-locales-{{ $lang }}-tab" data-toggle="pill" href="#seo-locales-{{ $lang }}" role="tab" aria-controls="seo-locales-{{ $lang }}" aria-selected="true">
                                {{ strtoupper($lang) }}
                            </a>
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
                                {!! Form::text( $lang . '[seo_title]', $stock->{'seo_title:'.$lang}??'',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_keywords')</label>
                                {!! Form::text( $lang . '[seo_keywords]', $stock->{'seo_keywords:'.$lang}??'',['class'=>'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.seo_description')</label>
                                {!! Form::text( $lang . '[seo_description]', $stock->{'seo_description:'.$lang}??'',['class'=>'form-control']) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.stocks.index')])