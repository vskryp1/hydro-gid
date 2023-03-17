{!! Form::open([
'id'     => 'service',
'route'  => 'frontend.forms.callback',
'method' => 'POST',
]) !!}
<div class="column-row">
    <div class="column">
        {!! Form::text('username', auth('web')->check() ? auth('web')->user()->name : null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/service/index.username'),
            'required',
        ]) !!}
        {!! Form::email('email', auth('web')->check() ? auth('web')->user()->email : null, [
            'class'       => 'form-control',
            'placeholder' => __('frontend/service/index.email'),
            'required',
        ]) !!}
        {!! Form::tel('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
           'class'       => 'form-control',
           'placeholder' => __('frontend/service/index.phone'),
           'required',
        ]) !!}
    </div>
    <div class="column">
        {!! Form::textarea('comment', null, [
            'placeholder' => __('frontend/service/index.write_comment'),
        ]) !!}
    </div>
</div>
{!! Form::hidden('page_id', $page->id) !!}
{!! Form::button(__('frontend/service/index.order'), ['type' => 'submit']) !!}
{!! Form::hidden('type', ServiceType::ORDER) !!}
{!! Form::close() !!}

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\SaveFormRequest', '#service') !!}
@endsection