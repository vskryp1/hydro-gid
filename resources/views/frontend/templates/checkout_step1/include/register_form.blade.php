{!! Form::open([
    'id'     => 'page-register-form',
    'class'  => 'login__form modal__form',
    'route'  => 'frontend.forms.checkout.step1',
    'method' => 'POST',
]) !!}
<div class="filter__items checkbox">
    <div class="filter-area">
        {!! Form::hidden('is_legal_entity', 0) !!}
        {!! Form::checkbox('is_legal_entity', 1, null, [
            'id' => 'legal-entity-input-cart',
        ]) !!}
        <label for="legal-entity-input-cart">
            {{ __('frontend/auth/index.i_am_legal_entity') }}
        </label>
    </div>
</div>
<div class="checkout__field">

    {!! Form::text('first_name', session()->get('temp_user')->first_name ?? null, [
        'class'       => 'form-control',
        'placeholder' => __('frontend/auth/index.first_name'),
        'required',
    ]) !!}
    {!! Form::text('last_name', session()->get('temp_user')->last_name ?? null, [
           'class'       => 'form-control',
           'placeholder' => __('frontend/auth/index.last_name'),
           'required',
    ]) !!}
    {!! Form::tel('phone', session()->get('temp_user')->phone ?? null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.phone'),
            'required',
    ]) !!}
    {!! Form::email('email', session()->get('temp_user')->email ?? null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/auth/index.email'),
            'required',
     ]) !!}
    {{--<div class="styled-select">--}}
{{--    <select >--}}
{{--        <option>Харьков</option>--}}
{{--        <option>Киев</option>--}}
{{--        <option>Одесса</option>--}}
{{--        <option>Херсон</option>--}}
{{--        <option>Запорожье</option>--}}
{{--        <option>Днепр</option>--}}
{{--        <option>Житомир</option>--}}
{{--        <option>Львов</option>--}}
{{--    </select>--}}
{{--    <div class="checkout__select-link">--}}
{{--        <span>Киев</span>--}}
{{--        <span>Одесса</span>--}}
{{--        <span>Херсон</span>--}}
{{--        <span>Запорожье</span>--}}
{{--        <span>Днепр</span>--}}
{{--        <span>Житомир</span>--}}
{{--        <span>Львов</span>--}}
{{--    </div>--}}
{{--</div>--}}
    <div class="legal--entity"></div>
    {!! Form::button(__('frontend/checkout/index.go_to_delivery_payment'), [
        'type'  => 'submit',
        'class' => 'checkout__step-next',
     //   'disabled' => 'true',
    ]) !!}
{!! Form::close() !!}

@section('scripts')
    @parent

    <script>
        window.global_var = {
            legalEntityTemplate: `@include('frontend.elements.forms.legal-entity')`,
        };
    </script>
@endsection