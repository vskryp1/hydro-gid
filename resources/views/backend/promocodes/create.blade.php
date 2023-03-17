@extends('backend.layouts.backend')

@section('title', __('backend.promocode_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open(['url' => route('backend.promocodes.store'),'method'=>'POST','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                @include('backend.promocodes.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        function enDisCount(element)
        {
            var target = $('[name=use_count]');
            if (element.prop('checked')) {
                target.prop('disabled', true);
            } else {
                target.prop('disabled', false);
            }
        }
        $(document).ready(function () {
            enDisCount($('[name=type_of_use]'));
            $('[name=type_of_use]').on('change', function () {
                enDisCount($(this));
            });
        });
    </script>
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Products\PromocodeRequest')->ignore('') !!}
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/backend/css/promocodes.css')) }}

@endsection

