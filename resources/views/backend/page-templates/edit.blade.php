@extends('backend.layouts.backend')

@section('title', __('backend.edit_template'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {!! Form::model($template, [
                'id'     => 'template-form',
                'class'  => "template form-horizontal form-label-left",
                'route'  => ['backend.templates.update', $template],
                'method' => 'PUT',
            ]) !!}
                <ul class="nav nav-tabs" id="nav-template" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" role="tab" aria-controls="base" aria-selected="true">
                            <i class="fa fa-cogs"></i>
                            @lang('backend.base')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="additional-fields-tab" data-toggle="tab" href="#additional-fields" role="tab" aria-controls="additional-fields" aria-selected="false">
                            <i class="fa fa-plus"></i>
                            @lang('backend.add_fields')
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active in" id="base" role="tabpanel" aria-labelledby="base-tab">
                        @include('backend.page-templates.fields')
                    </div>
                    <div class="tab-pane fade" id="additional-fields" role="tabpanel" aria-labelledby="additional-fields-tab">
                        <p>
                            <a href="" class="btn btn-success" onclick="jQuery('#add-field').modal('show', {backdrop: 'fade'}); return false;">
                                <span class="fa fa-plus"></span>
                                @lang('backend.add_field_add')
                            </a>
                        </p>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>@lang('backend.name')</th>
                                <th>@lang('backend.type')</th>
                                <th>@lang('backend.default_value')</th>
                                <th>@lang('backend.is_active')</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse($template->page_additional_field as $field)
                                    @php($type = $field->page_additional_field_type->type)
                                    <tr>
                                        <td>{{ $field->name }}</td>
                                        <td>{{ $type }}</td>
                                        <td>
                                            {!! Form::{$type}('add['. $type .'][' . $field->id . '][value]', $type == 'file' ? null : $field->default, [
                                                'class' => 'form-control',
                                            ]) !!}
                                        </td>
                                        <td>
                                            <div class="checkbox">
                                                {!! Form::checkbox('add['. $type .']['. $field->id.'][active]', 1, $field->active ?? true, [
                                                    'class' => 'js-switch',
                                                ]) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('backend.additional-field.delete', ['id' => $field->id]) }}" class="btn btn-danger del-field" data-confirm="@lang('backend.delete_question')">
                                                <i class="fa fa-remove"></i>
                                                @lang('backend.delete')
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="bg-warning">
                                            <h3 class="text-center">
                                                <i class="fa fa-info"></i>
                                                @lang('backend.nothing_found')
                                            </h3>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('backend.elements.save_buttons', [
                    'back_link'     => route('backend.templates.index'),
                    'destroy_link'  => route('backend.templates.destroy', ['id' => $template->id]),
                ])
            {!! Form::close() !!}
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="add-field">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open([
                    'id'    => 'additional-fields-form',
                    'class' => 'add-fields',
                    'route' => 'backend.additional-field.store',
                ]) !!}
                    {!! Form::hidden('page_template_id', $template->id) !!}
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @lang('backend.add_field_add')
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="add-active">
                                @lang('backend.is_active')
                            </label><br>
                            {!! Form::checkbox('active', 1, $template->active, [
                                'id'    => 'add-active',
                                'class' => 'js-switch',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="add-name">
                                @lang('backend.name')
                                <span class="text-danger">*</span>
                            </label>
                            {!! Form::text('name', null, [
                                'id'          => 'add-name',
                                'class'       => 'form-control',
                                'placeholder' => __('backend.name'),
                                'required',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="add-key">
                                @lang('backend.key')
                                <span class="text-danger">*</span>
                            </label>
                            {!! Form::text('key', null, [
                                'id'          => 'add-key',
                                'class'       => 'form-control',
                                'placeholder' => __('backend.key'),
                                'required',
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="add-type">
                                @lang('backend.type')
                            </label>
                            {!! Form::select('page_additional_field_type_id', $field_types, null, [
                                'id'          => 'add-type',
                                'class'       => 'form-control',
                                'placeholder' => __('backend.select_placeholder'),
                            ]) !!}
                        </div>
                        <div class="form-group">
                            <label for="add-default">
                                @lang('backend.default_value')
                            </label>
                            {!! Form::text('default', null, [
                                'id'          => 'add-default',
                                'class'       => 'form-control',
                                'placeholder' => __('backend.default_value'),
                            ]) !!}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">
                            <i class="fa fa-remove"></i>
                            @lang('backend.close')
                        </button>
                        <button type="submit" class="btn btn-info">
                            <i class="fa fa-save"></i>
                            @lang('backend.save')
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Page\PageTemplateRequest', '#template-form') !!}
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Page\PageAdditionalFieldRequest', '#additional-fields-form') !!}

    <script>
        $(document).ready(function () {
            $("[data-confirm]").click(function () {
                return confirm($(this).attr('data-confirm'));
            });

            $('.modal').on('shown.bs.modal', function () {
                $('[data-toggle=toggle]').bootstrapToggle('destroy');
                $('[data-toggle=toggle]').bootstrapToggle();
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
                $('[data-toggle=toggle]').bootstrapToggle('destroy');
                $('[data-toggle=toggle]').bootstrapToggle();
            });
        });
    </script>
@endsection