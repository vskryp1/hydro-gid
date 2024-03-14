@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/contacts.min.css')) !!}
@endsection

@section('scripts')
    @parent
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google_api.key') }}"></script>
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}

    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Auth\ResetPasswordRequest', '#reset-password') !!}
@endsection

@section('content')
    <main>
        <div class="container" id="modal-reset">
            <div class="modal__f">
                <div class="modal__inner modal__form">
                    <div class="ttl-top modal__title">
                        <span class="item-ttl">
                            @lang('frontend.forgot_password')
                        </span>
                    </div>
                    <div class="modal__content">
                        {{ Form::open(['id' => 'reset-password', 'url' => route("password.update")]) }}
                        {{ Form::hidden('token', $token) }}
                        <div class="form-field input-field" data-error="@lang('frontend.required_field')">
                            {{ Form::email('email', $email, ['class' => 'validate form-control', 'required', 'data-validate' => 'email', 'readonly', 'placeholder' => __('frontend.your_email')]) }}
                        </div>
                        <div class="form-field input-field" data-error="@lang('frontend.required_field')">
                            {{ Form::password('password', ["class" => "validate form-control", "required", 'placeholder' => __('frontend.password')]) }}
                        </div>
                        <div class="form-field input-field" data-error="@lang('frontend.required_field')">
                            {{ Form::password('password_confirmation', ['class' => 'validate form-control', 'required', 'placeholder' => __('frontend.repeat_password')]) }}
                        </div>

                        <button type="submit"
                                class="submit">@lang('frontend.save_data')</button>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
