{!! Form::open(['url' => route('frontend.forms.subscribe'), 'id' => 'subscribe-blog']) !!}
<div class="blog-one__form">
    <div class="blog-one__form-title">
        @lang('frontend/content/index.sign_up_on_mail')
    </div>
    <label>
        {!! Form::email('email', null, [
        'id'          => 'email',
        'class'       => 'footer__subscribe-input',
        'required'    => true,
        'placeholder' => 'E-mail*',
    ]) !!}
        <i class="icon icon-union"></i>
    </label>
    {!! Form::button(__('frontend/content/index.sign_up'), [
        'class' => 'footer__subscribe-btn',
        'type'  => 'submit',
    ]) !!}
</div>
{!! Form::close() !!}

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\SubscribeRequest', '#subscribe-blog') !!}
@endsection