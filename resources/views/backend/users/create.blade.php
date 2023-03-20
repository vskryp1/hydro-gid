@extends('backend.layouts.backend')

@section('title', __('backend.create_user'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="bgc-white p-20 bd">
                    <div class="mT-30">
                        {!! Form::open(['url' => route('backend.users.store'),'method'=>'POST','data-parsley-validate','autocomplete'=>'off']) !!}
                        @include('backend.users.fields')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Users\CreateRequest')->ignore('') !!}
@endsection