<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div>
            <div class="form-group">
                <label>@lang('backend.promocode')</label>
                {!! Form::text('alias', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('backend.types')</label>
                {!! Form::select('type', \App\Helpers\PromocodeHelper::getTypes(), null, ['class'=>'form-control select2_single']) !!}
            </div>
            <div class="form-group">
                <label>@lang('backend.discount_size')</label>
                {!! Form::text('original_discount_size', old('original_discount_size')??(isset($promocode)?ShopHelper::price_format($promocode->original_discount_size, true):0), ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label>@lang('backend.currency')</label>
                {!! Form::select('currency_id', $currencies_list??['-'], null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                <label class="form-group">@lang('backend.use_count')</label>
                <div class="form-group">
                    <div class="col-md-2 col-sm-2 col-xs-2" style="padding-left: 0px">
                        {!! Form::text('use_count', null, ['class'=>'form-control col-md-7']) !!}
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12" style="height: 34px; padding-top:5px">
                        {!! Form::checkbox('type_of_use', 1, null, ['class' => 'js-switch']) !!}
                        @lang('backend.unlimited')
                    </div>
                </div>
            </div>
            <div class=" control-group">
                <div class="controls">
                    <div class="xdisplay_inputx form-group">
                        <label>@lang('backend.expiration_date') (@lang('backend.month')/@lang('backend.day')
                            /@lang('backend.year'))</label>
                        {!! Form::text('expiration_date', (isset($promocode)) ? \Carbon\Carbon::parse($promocode->expiration_date)->format('m/d/Y') : null, ['class'=>'form-control', 'id' => 'single_cal2', 'aria-describedby' => "inputSuccess2Status2"]) !!}
                    </div>
                </div>
            </div>
            <div class="checkbox">
                {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                @lang('backend.active')
            </div>
        </div>
    </div>
</div>


@include('backend.elements.save_buttons', ['back_link' => route('backend.promocodes.index')])
