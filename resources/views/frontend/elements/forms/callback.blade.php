<div class="contacts__form">
    {!! Form::open([
       'route'  => 'frontend.forms.callback',
       'method' => 'POST',
       'files'  => true,
       'id'     => 'callback-service-form'
    ]) !!}
    <div class="contacts__form-title">
        @lang('frontend/content/index.callback')
    </div>
    <div class="contacts__form-line">
        <div class="contacts__form-phone">
            {!! Form::tel('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
                  'placeholder' => __('frontend/service/index.phone'),
            ]) !!}
        </div>
        <div class="contacts__form-check">
            <div class="filter__items checkbox">
                <div class="filter-area">
                    {!! Form::checkbox('call_me', 1, null, [  'id' => 'call-me' ]) !!}
                    {!! Form::label('call-me', __('frontend/content/index.call_me')) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="contacts__form-line">
        <div class="contacts__form-name">
            {!! Form::text('username', auth('web')->check() ? auth('web')->user()->name : null,
                ['placeholder' => __('frontend/service/index.username')]
             ) !!}
        </div>
        <div class="contacts__form-mail">
            {!! Form::email('email', auth('web')->check() ? auth('web')->user()->email : null,
                [ 'placeholder' => __('frontend/service/index.email')]
            ) !!}
        </div>
    </div>
    {!! Form::textarea('comment', null, [ 'placeholder' => __('frontend/content/index.write_message')]) !!}
    <div class="input-container input-container__file">
        <div class="icon icon-clip pb-3"></div>
        {!! Form::label('input-file', __('frontend/content/index.add_file'), [ 'class' => 'pb-3']) !!}
        {!! Form::file('file', [
            'id'                    => 'input-file',
            'accept'                => implode(',',config('app.file_mimes_front')),
            'data-error-type'       => __('frontend/content/index.error-type'),
            'data-error-size'       => __('frontend/content/index.error-size'),
            'data-error-existence'  => __('frontend/content/index.error-existence'),
            'class'                 => 'files pb-0 pt-2'
        ]) !!}
        <div class="delete"></div>
        <div class="text-error">@lang('frontend/content/index.upload_file')</div>
    </div>
    <div class="input-container__file-desckt">
        <div>@lang('frontend/content/index.do_not_exceed', ['size' =>  ShopHelper::setting('file_size', config('app.file_size')) / 1000])</div>
        <div>@lang('frontend/content/index.allowed_formats', ['formats' => ShopHelper::setting('file_mimes', config('app.file_mimes'))])</div>
    </div>
    {!! Form::button(__('frontend/content/index.send'), [ 'id' => 'btn_callback','type' => 'submit', 'data-checkbox-call_me' => __('frontend/content/index.call_me'), 'data-checkbox-send' => __('frontend/content/index.send') ]) !!}
    {!! Form::hidden('type', ServiceType::CONTACT) !!}
    {!! Form::close() !!}
</div>

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest', '#callback-service-form') !!}
@endsection
