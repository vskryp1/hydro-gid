<div class="details personal__tab-content">
    @empty($data['user']->discount)
    @else
        <div class="personal-discount">
            <div class="personal-discount-number">
                @if($data['user']->is_percentage)
                    {{ $data['user']->discount }}&#37;
                @else
                    {{ $data['user']->discount }}&#8372;
                @endif
            </div>
            <div class="personal-discount-text">
                <span>{{ __('frontend/profile/index.personal_discount') }}</span>
            </div>
        </div>
    @endempty
    <div class="personal__tab-title">
        {{ __('frontend/profile/index.my_data') }}
    </div>
    {!! Form::model($data['user'], [
        'id'     => 'user-data-form',
        'route'  => ['frontend.forms.user.update', $data['user']],
        'method' => 'PUT',
    ]) !!}
    <div class="details__input">
        <div class="details__input-col">
            <div class="fields" id="firstName">
                <label for="inputFirstName" class="personal__label">
                    {{ __('frontend/profile/index.first_name') }}
                </label>
                {!! Form::text('first_name', $data['user']->first_name ?? old('first_name'), [
                    'id'    => 'inputFirstName',
                    'class' => 'form-control personal__input',
                    'required','readonly',
                ]) !!}
            </div>
            <div class="fields">
                <label for="inputEmail" class="personal__label">
                    {{ __('frontend/profile/index.email') }}
                </label>
                {!! Form::email('email', $data['user']->email ?? old('email'), [
                    'id'    => 'inputEmail',
                    'class' => 'form-control personal__input',
                    'required','readonly',
                    'required',
                ]) !!}
            </div>
            @if($data['user']->is_legal_entity)
            <div class="fields" id="companyName">
                <label for="inputCompanyName" class="personal__label">
                    {{ __('frontend/profile/index.company_name') }}
                </label>
                {!! Form::text('company_name', $data['user']->company_name ?? old('company_name'), [
                    'id'    => 'inputCompanyName',
                    'class' => 'form-control personal__input',
                    'readonly',
                ]) !!}
            </div>
                @endif
        </div>
        <div class="details__input-col">
            <div class="fields" id="secondName">
                <label for="inputLastName" class="personal__label">
                    {{ __('frontend/profile/index.last_name') }}
                </label>
                {!! Form::text('last_name', $data['user']->last_name ?? old('last_name'), [
                    'id'    => 'inputLastName',
                    'class' => 'form-control personal__input',
                    'required','readonly',
                ]) !!}
            </div>
            <div class="fields">
                <label for="inputPhone" class="personal__label">
                    {{ __('frontend/profile/index.phone') }}
                </label>
                {!! Form::tel('phone', $data['user']->phone ?? old('phone'), [
                    'id'    => 'inputPhone',
                    'class' => 'form-control personal__input',
                    'required','readonly',
                ]) !!}
            </div>
            @if($data['user']->is_legal_entity)
            <div class="fields" id="code">
                <label for="inputEdrpou" class="personal__label">
                    {{ __('frontend/profile/index.edrpou') }}
                </label>
                {!! Form::text('edrpou', $data['user']->edrpou ?? old('edrpou'), [
                    'id'    => 'inputEdrpou',
                    'class' => 'form-control personal__input',
                    'readonly',
                ]) !!}
            </div>
                @endif
        </div>
    </div>
    <a class="change-password" data-fancybox data-src="#modal-pass" href="#">
        {{ __('frontend/profile/index.change_password') }}
    </a>
    <div class="per_edit" data-block-save style="display: none">
        <div class="personal__cans">
            {!! Form::button(__('frontend/profile/index.cancel'), [
                'class' => 'btn btn-lg btn-safe', 'type' => 'reset'
            ]) !!}
        </div>

        <div class="personal__save">
            {!! Form::button(__('frontend/profile/index.save'), [
                'type' => 'submit',
            ]) !!}
        </div>
    </div>

    <div class="personal__edit" data-block-edit>
        {!! Form::button(__('frontend/profile/index.edit'), [
            'class' => 'btn edit-btn', 'type' => 'button'
        ]) !!}
    </div>
    {!! Form::close() !!}
</div>
