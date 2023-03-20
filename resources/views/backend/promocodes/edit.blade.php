@extends('backend.layouts.backend')

@section('title', __('backend.promocode_edit'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
                           aria-controls="home" aria-selected="true">
                            @lang('backend.base') </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" data-tab="#orders" role="tab"
                           aria-controls="orders" aria-selected="true">
                            @lang('backend.orders') </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="base" role="tabpanel"
                         aria-labelledby="home-tab">
                        {!! Form::model($promocode, ['url' => route('backend.promocodes.update', ['promocode' => $promocode]),'method'=>'PUT','autocomplete'=>'off', 'class'=>'form-horizontal form-label-left']) !!}
                        {!! Form::hidden('id', $promocode->id) !!}
                            @include('backend.promocodes.fields')
                        {!! Form::close() !!}
                    </div>
                    <div class="tab-pane fade in" id="orders" role="tabpanel"
                         aria-labelledby="home-tab">
                        @include('backend.orders.table', ['orders' => $orders])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    @parent

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
    {{ Html::style(mix('assets/backend/css/promocodes.css')) }}
@endsection
