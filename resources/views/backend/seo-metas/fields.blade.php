<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="js_seo_url">@lang('backend.url')</label>
                        <small>@lang('backend.seo_url_info')</small>
                        {!! Form::text('seo_url',null,['class'=>'form-control','placeholder'=>__('backend.url'),'required','id'=>'js_seo_url']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_title">@lang('backend.title')</label>
                        {!! Form::text('seo_title',null,['class'=>'form-control','placeholder'=>__('backend.title'),'id'=>'js_seo_title']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_key">@lang('backend.key')</label>
                        {!! Form::text('seo_keywords',null,['class'=>'form-control','placeholder'=>__('backend.key'),'id'=>'js_seo_key']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_desc">@lang('backend.description')</label>
                        {!! Form::text('seo_description',null,['class'=>'form-control','placeholder'=>__('backend.description'),'id'=>'js_seo_desc']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_robots">@lang('backend.robots')</label>
                        {!! Form::text('seo_robots',null,['class'=>'form-control','placeholder'=>__('backend.robots'),'id'=>'js_seo_robots']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_canonical">@lang('backend.canonical')</label>
                        {!! Form::text('seo_canonical',null,['class'=>'form-control','placeholder'=>__('backend.canonical'),'id'=>'js_seo_canonical']) !!}
                    </div>
                    <div class="form-group">
                        <label for="js_seo_content">@lang('backend.content')</label>
                        {!! Form::textarea('seo_content',null,['class'=>'form-control ck-editor','placeholder'=>__('backend.content'),'id'=>'js_seo_content']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.seo-metas.index')])