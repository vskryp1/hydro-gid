{!! Form::open([
    'route'  => 'frontend.forms.callback',
    'method' => 'POST',
    'id'     => 'faq-service-form',
    'files'  => true,
]) !!}
<div class="column-row">
    <div class="column">
        <div class="input-field">
            {!! Form::text('username', auth('web')->check() ? auth('web')->user()->name : null, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/service/index.username'),
                'required',
            ]) !!}
        </div>
        <div class="input-field">
            {!! Form::email('email', auth('web')->check() ? auth('web')->user()->email : null, [
                'class'       => 'form-control',
                'placeholder' => __('frontend/service/index.email'),
                'required',
            ]) !!}
        </div>
        <div class="input-field">
            {!! Form::text('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
               'class'       => 'form-control',
               'placeholder' => __('frontend/service/index.phone'),
               'required',
            ]) !!}
        </div>
    </div>
    <div class="column p">
        {!! Form::textarea('comment', null, [
            'placeholder' => __('frontend/service/index.write_comment'),
        ]) !!}
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
            <div class="input-container__file-desckt">
                <div>@lang('frontend/content/index.do_not_exceed', ['size' =>  ShopHelper::setting('file_size', config('app.file_size')) / 1000])</div>
                <div>@lang('frontend/content/index.allowed_formats', ['formats' => ShopHelper::setting('file_mimes', config('app.file_mimes'))])</div>
            </div>
        </div>
    </div>
</div>
{!! Form::hidden('page_id', $page->id) !!}
{!! Form::button(__('frontend/service/index.ask_question_btn'), ['type' => 'submit']) !!}
{!! Form::hidden('type', ServiceType::QUESTION) !!}
{!! Form::close() !!}

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest', '#faq-service-form') !!}
@endsection
