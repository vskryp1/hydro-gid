{!! Form::open([
    'id'     => 'login-form',
    'class'  => 'login__form modal__form',
    'route'  => 'login',
    'method' => 'POST',
]) !!}
    <label>
        {!! Form::email('email', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.email'),
            'required',
        ]) !!}
    </label>
    <label>
        {!! Form::password('password', [
            'class'        => 'form-control',
            'placeholder'  => __('frontend/auth/index.password'),
            'autocomplete' => 'new-password',
            'required',
        ]) !!}
    </label>
    <div class="modal__form-link">
        <a href="#" data-fancybox data-src="#modal-pass-new">
            {{ __('frontend/auth/index.buttons.forgot_password') }}
        </a>
    </div>
    {!! Form::button(__('frontend/auth/index.buttons.login'), [
        'type' => 'submit',
    ]) !!}
{!! Form::close() !!}