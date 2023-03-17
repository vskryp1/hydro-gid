@extends('backend.layouts.backend')

@section('title', __('backend.filters'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.filters.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                    'create_link'  => route('backend.filters.create'),
                    'name'         => __('backend.filter_create'),
        ])
    <div class="table-responsive">
        <table class="table-index table table-striped">
            <thead>
            <tr>
                <th width="15%">@lang('backend.name')</th>
                <th width="10%">@lang('backend.type')</th>
                <th width="45%">@lang('backend.categories')</th>
                <th width="10%" class="text-center">@lang('backend.active')</th>
                <th width="20%"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($filters as $filter)
                <tr>
                    <td>{{ $filter->name }}</td>
                    <td>{{ $filter->filter_type->name }}</td>
                    <td>{{implode(', ', $filter->pages->pluck('name')->toArray())}}</td>
                    <td class="text-center text-uppercase">
                        @if($filter->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.filters.edit', ['filter'=> $filter]),
                                'destroy_link' => route('backend.filters.destroy', ['filter'=> $filter]),
                                'model'        => $filter,
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
        {{ $filters->links('backend.elements.pagination') }}
    </div>

@endsection
