@extends('backend.layouts.backend')

@section('title')
    @lang('backend.import_export_clients')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @lang('backend.export_clients_excel')
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <i>
                            @lang('backend.export_datap_excel')
                        </i>
                    </p>
                    <p class="text-danger">
                        @lang('backend.example_for_import')
                    </p>
                    {!! Form::open([
                        'route'  => 'backend.export.clients',
                        'method' => 'GET',
                    ]) !!}
                    {!! Form::submit(__('backend.export')); !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection