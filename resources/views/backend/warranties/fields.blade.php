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
                            <label>@lang('backend.position')</label>
                            {!! Form::number('position',  null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.categories')</label>
                           {!! Form::select('page_id', $categories , null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.warranty_amount')</label>
                            {!! Form::number('amount',  null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.warranty_price')</label>
                            {!! Form::number('price', old('price')??(isset($warranty)?round($warranty->price, 2):0),['class'=>'form-control','placeholder'=> __('backend.price'),'required', 'step'=>0.01,'min'=>0.1]) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.warranties.index')])