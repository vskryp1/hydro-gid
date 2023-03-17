@extends('backend.layouts.backend')

@section('title', __('backend.edit_user'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="bgc-white p-20 bd">
                    {!! Form::model($user, ['url' => route('backend.users.update',['user'=> $user]),'method'=>'PUT','data-parsley-validate','autocomplete'=>'off']) !!}
                    @include('backend.users.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Users\UpdateRequest')->ignore('') !!}
    <script>
        $(document).ready(function () {
            $("[data-confirm]").click(function () {
                return confirm($(this).attr('data-confirm'));
            });
        });
    </script>
@endsection
