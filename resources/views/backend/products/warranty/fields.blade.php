<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link"
               id="base-tab"
               data-toggle="tab"
               href="#base"
               data-tab="#base"
               role="tab"
               aria-controls="home"
               aria-selected="true">
                @lang('backend.base')
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="amount">@lang('backend/product/index.amount_of_time')</label><br>
                        {!! Form::number(
                            'amount',
                            isset($warranty) ? $warranty->amount : null,
                            ['id' => 'amount', 'class' => 'form-control']
                        ) !!}
                    </div>
                    <div class="form-group">
                        <label for="price">@lang('backend.price')</label><br>
                        {!! Form::number('price', old('price')??(isset($warranty)?round($warranty->price, 2):0),['class'=>'form-control','placeholder'=> __('backend.price'),'required', 'step'=>0.01,'min'=>0.1]) !!}
                    </div>
                    <div class="form-group">
                        <label for="position">@lang('backend.position')</label><br>
                        {!! Form::number('position', null, ['id' => 'position', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="position">@lang('backend.active')</label><br>
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, null, ['id' => 'position', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@isset($product)
    @include('backend.elements.save_buttons', ['back_link' => route('backend.products.edit', $product) . '#warranty'])
@endisset