@extends('backend.layouts.backend')

@section('title', __('backend.edit_roles'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="bgc-white p-20 bd">
                {!! Form::model($role, [
                    'url' => route('backend.roles.update', ['role' => $role]),
                    'method'=>'PUT',
                    'data-parsley-validate',
                    'autocomplete'=>'off'
                ]) !!}
                @include('backend.roles.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Users\CreateRole')->ignore('') !!}
    <script>
        $(document).ready(function () {
            $("[data-confirm]").click(function () {
                return confirm($(this).attr('data-confirm'));
            });
        });
    </script>
@endsection