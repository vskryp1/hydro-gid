{!! Form::open([
    'id'     => 'register-form',
    'class'  => 'login__form modal__form',
    'route'  => 'register',
    'method' => 'POST',
]) !!}
    <div class="filter__items checkbox">
        <div class="filter-area">
            {!! Form::hidden('is_legal_entity', 0) !!}
            {!! Form::checkbox('is_legal_entity', 1, null, [
                'id' => 'inputIsLegalEntity',
            ]) !!}
            <label for="inputIsLegalEntity">
                {{ __('frontend/auth/index.i_am_legal_entity') }}
            </label>
        </div>
    </div>
    <div class="legal--entity"></div>
    <label>
        {!! Form::text('first_name', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.first_name'),
            'required',
        ]) !!}
    </label>
    <label>
        {!! Form::text('last_name', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.last_name'),
            'required',
        ]) !!}
    </label>
    <label>
        {!! Form::email('email', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.email'),
            'required',
        ]) !!}
    </label>
    <label>
        {!! Form::tel('phone', null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.phone'),
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
    <label>
        {!! Form::password('password_confirmation', [
            'class'        => 'form-control',
            'placeholder'  => __('frontend/auth/index.password_confirmation'),
            'autocomplete' => 'new-password-confirmation',
            'required',
        ]) !!}
    </label>
    {!! Form::button(__('frontend/auth/index.buttons.register'), [
        'type'  => 'submit',
        'class' => 'registration__btn',
    ]) !!}
{!! Form::close() !!}