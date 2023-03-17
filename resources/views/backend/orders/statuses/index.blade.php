@extends('backend.layouts.backend')

@section('title', __('backend.order_status'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.orders.statuses.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                        'create_link'  => route('backend.orders.statuses.create'),
                        'name'         => __('backend.create_status'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th class="text-center">@lang('backend.default')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($order_statuses as $order_status)
                <tr>
                    <td>{{ $order_status->name }}</td>
                    <td class="text-center text-uppercase">
                        @if($order_status->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-center text-uppercase">
                        @if($order_status->default)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.orders.statuses.edit', ['status' => $order_status]),
                                        'destroy_link' => route('backend.orders.statuses.destroy', ['status' => $order_status]),
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
        {{ $order_statuses->links('backend.elements.pagination') }}
    </div>
@endsection
