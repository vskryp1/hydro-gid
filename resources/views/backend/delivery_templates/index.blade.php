@extends('backend.layouts.backend')

@section('title', __('backend.delivery_templates'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.products.delivery_templates.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.products.delivery_templates.create'),
                'name'         => __('backend.delivery_templates_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th width="45%">@lang('backend.template')</th>
                <th class="text-center">@lang('backend.position')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($delivery_templates as $delivery_template)
                <tr>
                    <td>{{ $delivery_template->name }}</td>
                    <td>{{ $delivery_template->template }}</td>
                    <td class="text-center">{{ $delivery_template->position }}</td>

                    <td class="text-center text-uppercase">
                        @if($delivery_template->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.products.delivery_templates.edit', ['delivery_template' => $delivery_template]),
                                        'destroy_link' => route('backend.products.delivery_templates.destroy', ['delivery_template' => $delivery_template]),
                                ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="bg-warning">
                        <h3 class="text-center">
                            @lang('backend.nothing_found')
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $delivery_templates->links('backend.elements.pagination') }}
    </div>

@endsection
