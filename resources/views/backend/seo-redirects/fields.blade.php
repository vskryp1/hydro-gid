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
                        <label>@lang('backend.status_code')</label>
                        {!! Form::select('status_code',['301' => '301', '302' => '302', '303' => '303'],null,['class'=>'form-control','required']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.from_desc')</label>
                        {!! Form::text('from',null,['class'=>'form-control','placeholder'=>__('backend.from'),'required']) !!}
                    </div>

                    <div class="form-group">
                        <label>@lang('backend.to_desc')</label>
                        {!! Form::text('to',null,['class'=>'form-control','placeholder'=>__('backend.to'),'required']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.seo-redirects.index')])