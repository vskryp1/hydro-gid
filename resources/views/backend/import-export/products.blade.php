@extends('backend.layouts.backend')

@section('title')
    @lang('backend.import_export_products')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @lang('backend.export_products_excel')
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
                    <button type="button" data-toggle="modal" data-target="#selectFieldsExportModal">
                        <i class="fa fa-upload"></i>
                        @lang('backend.export')
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @lang('backend.import_products_excel')
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <i>
                            @lang('backend.import_data_excel')
                        </i>
                    </p>
                    {!! Form::open([
                        'route'  => 'backend.import.product.headers',
                        'method' =>'PUT',
                        'files'  => true,
                    ]) !!}
                    {!! Form::file('file', [
                        'accept' => '.xls, .xlsx',
                    ]) !!}
                    {!! Form::submit(__('backend.import')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        @lang('backend.import_prices_products_excel')
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>
                        <i>
                            @lang('backend.import_prices_datap_excel')
                        </i>
                    </p>
                    {!! Form::open([
                        'route'  => 'backend.import.prices.products',
                        'method' =>'POST',
                        'files'  => true,
                    ]) !!}
                    {!! Form::file('file', [
                        'accept' => '.xls, .xlsx',
                    ]) !!}
                    {!! Form::submit(__('backend.import')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.export.select_fields_export_modal', [
    'columns' => $columnsForExport,
    'route'   => 'backend.export.products',
])