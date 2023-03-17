{!! Form::open(['url' => route('frontend.forms.subscribe'), 'id' => 'subscribe-footer']) !!}
    {!! Form::email('email', null, [
        'id'       => 'email',
        'class'    => 'footer__subscribe-input',
        'required' => true,
        'placeholder' => 'Ваш E-mail'
    ]) !!}
    {!! Form::button(__('frontend.subscribe'), [
        'class' => 'footer__subscribe-btn',
        'type'  => 'submit',
    ]) !!}
{!! Form::close() !!}

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\SubscribeRequest', '#subscribe-footer') !!}
@endsection
