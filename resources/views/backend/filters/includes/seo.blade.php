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
                        {!! Form::text($lang . '[seo_title]',   isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_title : null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.seo_keywords')</label>
                        {!! Form::text($lang . '[seo_keywords]',isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_keywords : null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.seo_description')</label>
                        {!! Form::text($lang . '[seo_description]', isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_description : null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.seo_robots')</label>
                        {!! Form::text($lang . '[seo_robots]', isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_robots : null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.seo_canonical')</label>
                        {!! Form::text($lang . '[seo_canonical]', isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_canonical : null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="roleName">@lang('backend.seo_content')</label>
                        {!! Form::textarea($lang . '[seo_content]', isset($filter) && $filter->translate($lang) ? $filter->translate($lang)->seo_content : null,['class'=>'form-control ck-editor']) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
</div>