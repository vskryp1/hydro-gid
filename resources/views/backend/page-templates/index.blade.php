@extends('backend.layouts.backend')

@section('title', __('backend.templates'))

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            @include('backend.elements.create_button', [
                 'create_link' => route('backend.templates.create'),
                 'name'        => __('backend.create_template'),
             ])
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th width="40%">@lang('backend.name')</th>
                            <th width="30%">@lang('backend.category')</th>
                            <th width="10%">@lang('backend.active')</th>
                            <th width="20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $template)
                            <tr>
                                <td>{{ $template->name }}</td>
                                <td class="text-uppercase">
                                    @if($template->is_category)
                                        <span class="label label-success">
                                            @lang('backend.yes')
                                        </span>
                                    @else
                                        <span class="label label-default">
                                            @lang('backend.no')
                                        </span>
                                    @endif
                                </td>
                                <td class="text-uppercase">
                                    @if($template->active)
                                        <span class="label label-success">
                                            @lang('backend.yes')
                                        </span>
                                    @else
                                        <span class="label label-danger">
                                            @lang('backend.no')
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.templates.edit', ['template' => $template]),
                                        'destroy_link' => route('backend.templates.destroy', ['id' => $template->id]),
                                        'restore_link' => route('backend.templates.restore', ['id' => $template->id]),
                                        'model'        => $template,
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="bg-warning">
                                    <h3 class="text-center">
                                        @lang('backend.nothing_found')
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="bg-warning">
                                {!! $templates->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection