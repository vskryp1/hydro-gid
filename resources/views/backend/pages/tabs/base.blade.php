<div class="root-tab tab-pane in active" id="base" role="tabpanel" aria-labelledby="home-tab">
    {{ Form::hidden('id', isset($page->id) ? $page->id : null) }}
    <div class="checkbox">
        {{ Form::hidden('active', 0) }}
        {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
        @lang('backend.active')
    </div>
    <div class="checkbox">
        {{ Form::hidden('only_auth', 0) }}
        {!! Form::checkbox('only_auth', 1, null, ['class' => 'js-switch']) !!}
        @lang('backend.only_auth')
    </div>
    <div class="checkbox">
        {{ Form::hidden('use_sitemap', 0) }}
        {!! Form::checkbox('use_sitemap', 1, old('use_sitemap')??(isset($page)?$page->use_sitemap:true), ['class' => 'js-switch']) !!}
        @lang('backend.use_sitemap')
    </div>
    @if(isset($page) && $page->page_template->is_category)
        <div class="checkbox">
            {{ Form::hidden('is_calculator_exclude', 0) }}
            {!! Form::checkbox('is_calculator_exclude', 1, null, ['class' => 'js-switch']) !!}
            @lang('backend.is_calculator_exclude')
        </div>
    @endif
    <div class="form-group">
        <label for="validationCustom02">@lang('backend.url')</label>
        <small class="form-text text-muted">@lang('backend.must_unique')</small>
        <div class="input-group">
            <span class="input-group-addon" id="addon-url">{{url('/')}}/</span>
            {!! Form::text('alias', old('alias', (isset($page) ? $page->getOriginal('alias') : null)),['class'=>'form-control','placeholder'=>__('backend.url')]) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="validationCustom03">@lang('backend.template')</label>
        {!! Form::select('page_template_id', $templates, null,['class'=>'form-control', 'required']) !!}
    </div>
    <div class="form-group">
        <label>@lang('backend.products')</label>
        {!! Form::select('products[]', $products, $page->products ?? [], ['class'=>'form-control select2 js_categories', 'multiple' => "multiple"]) !!}
    </div>
    <div class="clearfix"></div>
</div>