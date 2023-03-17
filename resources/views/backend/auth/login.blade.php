@extends('backend.layouts.app')

@section('body_class','login')

@section('title', __('backend.login'))

@section('page')
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    {{ Form::open(['route' => 'backend.login', 'autocomplete' => 'off']) }}
                    <h1>@lang('backend.login')</h1>
                    <div>
                        {!! Form::email('email', old('email'), ['class'=>'form-control', 'required', 'autofocus']) !!}
                    </div>
                    <div>
                        {!! Form::password('password', ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="checkbox al_left">
                        <label>
                            {!! Form::checkbox('remember', old('remember'), ['class'=>'form-control']) !!}
                            @lang('backend.remember_me')
                        </label>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (!$errors->isEmpty())
                        <div class="alert alert-danger" role="alert">
                            {!! $errors->first() !!}
                        </div>
                    @endif

                    <div>
                        <button class="btn btn-default submit" type="submit">@lang('backend.login')</button>
                    </div>

                    <div class="clearfix"></div>

                    {{ Form::close() }}
                </section>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/auth/css/auth.css')) }}
@endsection