@extends('backend.layouts.backend')

@section('title', __('backend.product_status'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.products.statuses.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.products.statuses.create'),
                'name'         => __('backend.create_status'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th class="text-center">@lang('backend.in_stock')</th>
                <th class="text-center">@lang('backend.default')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($product_statuses as $product_status)
                <tr>
                    <td>{{ $product_status->name }}</td>
                    <td class="text-center text-uppercase">
                        @if($product_status->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-center text-uppercase">
                        @if($product_status->in_stock)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($product_status->default)
                            <div class="label label-success">@lang('backend.yes')</div>
                        @else
                            <div class="label label-danger">@lang('backend.no')</div>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.products.statuses.edit', ['status' => $product_status]),
                                        'destroy_link' => route('backend.products.statuses.destroy', ['status' => $product_status]),
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
        {{ $product_statuses->links('backend.elements.pagination') }}
    </div>

@endsection
