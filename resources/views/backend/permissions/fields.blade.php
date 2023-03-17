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
                    <div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.name')</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>__('backend.name'),'required','id'=>'roleName']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.permissions.index')])