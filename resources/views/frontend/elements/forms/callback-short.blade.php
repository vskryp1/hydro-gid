<div id="modal-call">
    <div class="modal__inner">
        <div class="modal__title">
            @lang('frontend/service/index.we_will_call_you')
        </div>
        <div class="modal__content">
            {!! Form::open([
              'route'  => 'frontend.forms.callback',
              'method' => 'POST',
              'files'  => true,
              'id'     => 'callback-form',
              'class'  => 'login__form modal__form'
            ]) !!}
            <label>
                {!! Form::text('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
                     'placeholder' => __('frontend/service/index.phone'),
                ]) !!}
            </label>
            {!! Form::button(__('frontend/content/index.call_me'), [ 'type' => 'submit', 'class' => 'main-btn main-btn--green main-btn--center' ]) !!}
            {!! Form::hidden('call_me', true) !!}
            {!! Form::hidden('type', ServiceType::CALLBACK) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest', '#callback-form') !!}
@endsection