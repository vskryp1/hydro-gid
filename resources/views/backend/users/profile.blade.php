@extends('backend.layouts.backend')

@section('title', __('backend.edit_user'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="bgc-white p-20 bd">
                    {!! Form::model($user, ['url' => route('backend.users.profile.update'),'method'=>'PUT','data-parsley-validate','autocomplete'=>'off']) !!}
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item active">
                                <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
                                   aria-controls="home" aria-selected="true">
                                    @lang('backend.base') </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="base" role="tabpanel"
                                 aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <div>
                                            <div class="form-group">
                                                <label for="userCreateName">@lang('backend.first_name')</label>
                                                {!! Form::text('name', null,['class'=>'form-control','placeholder'=>__('backend.name'),'required','id'=>'userCreateName']) !!}
                                            </div>
                                            <div class="form-group">
                                                <label for="userCreateEmail">@lang('backend.email')</label>
                                                {!! Form::email('email', null,['class'=>'form-control','placeholder'=>__('backend.email'),'required','id'=>'userCreateEmail']) !!}
                                                <small id="emailHelp" class="form-text text-muted">@lang('backend.email_help')</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="userCreatePhone">@lang('backend.phone')</label>
                                                {!! Form::text('phone',null,['class'=>'form-control','placeholder'=>'000-000-00-00','id'=>'userCreatePhone']) !!}
                                                <small id="phoneHelp" class="form-text text-muted">@lang('backend.phone_help')</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="userCreatePassword">@lang('backend.password')</label>
                                                {!! Form::password('password',['class'=>'form-control','placeholder'=>__('backend.password'),'required','id'=>'userCreatePassword']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('backend.elements.save_buttons', ['back_link' => route('backend.dashboard')])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("[data-confirm]").click(function () {
                return confirm($(this).attr('data-confirm'));
            });
        });
    </script>
@endsection
