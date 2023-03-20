<label>
    {!! Form::text('company_name', null, [
        'class'       => 'form-control',
        'placeholder' => __('frontend/auth/index.company_name'),
        'required',
    ]) !!}
</label>
<label>
    {!! Form::number('edrpou', null, [
        'class'       => 'form-control',
        'placeholder' => __('frontend/auth/index.edrpou'),
        'required',
    ]) !!}
</label>