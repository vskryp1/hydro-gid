@extends('backend.layouts.backend')

@section('title', __('backend.edit_permission'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12">
                <div class="bgc-white p-20 bd">
                    {!! Form::model($permission, [
                        'url' => route('backend.permissions.update',
                        ['permission' => $permission]),
                        'method'=>'PUT',
                        'data-parsley-validate',
                        'autocomplete'=>'off'
                    ]) !!}
                    @include('backend.permissions.fields')
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
