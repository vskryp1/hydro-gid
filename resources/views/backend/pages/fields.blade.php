<ul class="root-tab nav nav-tabs" id="myTab" role="tablist">
    <li class="active">
        <a id="base-tab" data-toggle="tab" href="#base" role="tab" aria-expanded="true">
            @lang('backend.base')
        </a>
    </li>
    @if(Route::is('backend.pages.edit'))
        <li class="nav-item">
            <a class="" id="additional-fields-tab" data-toggle="tab" href="#additional-fields" role="tab"
               aria-expanded="false">
                @lang('backend.add_fields')
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" role="tab" aria-expanded="false">
            @lang('backend.locale')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-expanded="false">
            @lang('backend.seo')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="parent-tab" data-toggle="tab" href="#parent" data-tab="#parent" role="tab"
           aria-controls="profile" aria-selected="false">
            @lang('backend.parent')
        </a>
    </li>
    @if(isset($page) && $page->page_template->is_category)
        <li class="nav-item">
            <a class="nav-link" id="category_options-tab" data-toggle="tab" href="#category_options"
               data-tab="#category_options" role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.category_options')
            </a>
        </li>
    @endif
</ul>

<div class="tab-content">
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
        <div class="clearfix"></div>
    </div>
    @if(Route::is('backend.pages.edit'))
        <div class="root-tab tab-pane fade" id="additional-fields" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class="@if ($loop->first) active @endif">
                            <a class="nav-link"
                               id="v-pills-{{ $lang }}-tab"
                               data-toggle="pill"
                               href="#v-pills-{{ $lang }}"
                               role="tab"
                               aria-controls="v-pills-{{ $lang }}"
                               aria-selected="true">{{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane  @if ($loop->first) active @endif"
                             id="v-pills-{{ $lang }}">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <td width="250px">@lang('backend.name')</td>
                                <td width="150px">@lang('backend.type')</td>
                                <td>@lang('backend.value')</td>
                                </thead>
                                <tbody>
                                @forelse($page_add_fields as $field)
                                    @php($value = $page->getAdditionalFieldByKey($field->key, $field->default))
                                    @php($type = $field->page_additional_field_type->type)

                                    <tr>
                                        <td>
                                            {{ $field->name }}<br>
                                        </td>
                                        <td>{{ $type }}</td>
                                        <td>
                                            @if($type == 'file')
                                                {!! Form::text('add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]', $value, ['class' => 'form-control'])!!}
                                            @endif
                                            {!! Form::{$type}(
                                                'add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]',
                                                $type == 'file' ? null : $value,
                                                ['class' => 'form-control']
                                            )!!}
                                            @if($type == 'file' && $value != '' && Storage::disk('public')->exists(\App\Models\Page\Page::GALLERY_PATH.$value))
                                                <img src="/storage/cache/page_md/{{ $value }}"
                                                     width="100px">
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">@lang('backend.nothing_found')</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    @endif

    <div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row tabs-vertical-env tabs-vertical-bordered">
            <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                @foreach(Setting::get('locales') as $lang => $locale)
                    <li class="@if ($loop->first) active @endif">
                        <a class="nav-link"
                           id="v-pills-{{ $lang }}-tab"
                           data-toggle="pill"
                           href="#v-pills-{{ $lang }}-locale"
                           aria-controls="v-pills-{{ $lang }}"
                           aria-selected="true">{{ strtoupper($lang) }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" id="v-pills-tabContent-locale">
                @foreach(Setting::get('locales') as $lang => $locale)
                    <div class="tab-pane  @if ($loop->first) active @endif" id="v-pills-{{ $lang }}-locale">
                        <div class="form-group">
                            <label for="roleName">@lang('backend.page_title')</label>
                            {!! Form::text($lang . '[name]', isset($page) && $page->translate($lang) ? $page->translate($lang)->name : null  ,['class'=>'form-control','data-validation'=>'required', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.introtext')</label>
                            {!! Form::textarea($lang . '[introtext]',  isset($page) && $page->translate($lang) ? $page->translate($lang)->introtext : null ,['class'=>'form-control, ck-editor']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.description')</label>
                            {!! Form::textarea($lang . '[description]', isset($page) && $page->translate($lang) ? $page->translate($lang)->description : null,['class'=>'form-control, ck-editor']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="root-tab tab-pane fade" id="seo" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row tabs-vertical-env tabs-vertical-bordered">
            <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist"
                aria-orientation="vertical">
                @foreach(Setting::get('locales') as $lang => $locale)
                    <li class="@if ($loop->first) active @endif">
                        <a class="nav-link"
                           id="v-pills-{{ $lang }}-tab"
                           data-toggle="pill"
                           href="#v-pills-{{ $lang }}-SEO"
                           role="tab"
                           aria-controls="v-pills-{{ $lang }}"
                           aria-selected="true">{{ strtoupper($lang) }}
                        </a>
                    </li>
                @endforeach

            </ul>
            <div class="tab-content" id="v-pills-tabContent-SEO">
                @foreach(Setting::get('locales') as $lang => $locale)
                    <div class="tab-pane @if ($loop->first) active @endif"
                         id="v-pills-{{ $lang }}-SEO">
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_title')</label>
                            {!! Form::text($lang . '[seo_title]',   isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_title : null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_keywords')</label>
                            {!! Form::text($lang . '[seo_keywords]',isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_keywords : null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_description')</label>
                            {!! Form::text($lang . '[seo_description]', isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_description : null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_robots')</label>
                            {!! Form::text($lang . '[seo_robots]', isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_robots : null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_canonical')</label>
                            {!! Form::text($lang . '[seo_canonical]', isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_canonical : null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.seo_content')</label>
                            {!! Form::textarea($lang . '[seo_content]', isset($page) && $page->translate($lang) ? $page->translate($lang)->seo_content : null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="root-tab tab-pane fade" id="parent" role="tabpanel" aria-labelledby="home-tab">
        <br>
        <div class="row">
            <br>
            <div class="col-sm-10">
                <div class="tab-content" id="v-pills-tabContent-parent">
                    <div id="tree_container">
                        <div id="js_tree"></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    @if(isset($page) && $page->page_template->is_category)
        <div class="root-tab tab-pane fade" id="category_options" role="tabpanel"
             aria-labelledby="category_options-tab">
            <div class="row">
                    <a href="{{route('backend.pages.products', ['page' => $page->id])}}"
                       class="btn btn-default text-uppercase"><i
                                class="fa fa-sort"></i> @lang('backend.page_product')</a>
            </div>
            <br>
            <div class="row">
                    <a href="{{route('backend.pages.filters', ['page' => $page->id])}}"
                       class="btn btn-default text-uppercase"><i
                                class="fa fa-check-square-o"></i> @lang('backend.filter_page')</a>

            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <label>@lang('backend.customizations')</label>
                    {!! Form::select('customizations[]', $customizations??[], $page->customizations()->pluck('id'), ['class' => 'form-control has-feedback-left select2', 'multiple' => true])!!}
                </div>
            </div>
            <br>
        </div>
    @endif
</div>