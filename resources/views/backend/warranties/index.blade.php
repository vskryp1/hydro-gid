@extends('backend.layouts.backend')

@section('title', __('backend.warranties'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.warranties.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.warranties.create'),
                'name'         => __('backend/product/index.warranty_create_new'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.position')</th>
                <th width="">@lang('backend.category')</th>
                <th width="">@lang('backend.warranty_amount')</th>
                <th>@lang('backend.warranty_price')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($warranties as $warranty)
                <tr>
                    <td>{{ $warranty->position }}</td>
                    <td>{{ $warranty->category->name }}</td>
                    <td>{{ $warranty->amount }}</td>
                    <td>{{ round($warranty->price, 2) }} @lang('backend/product/index.uah')</td>
                    <td class="text-center text-uppercase">
                        @if($warranty->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.warranties.edit', ['warranty' => $warranty]),
                                        'destroy_link' => route('backend.warranties.destroy', ['warranty' => $warranty]),
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
        {{ $warranties->links('backend.elements.pagination') }}
    </div>

@endsection
