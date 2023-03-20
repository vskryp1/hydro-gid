@extends('backend.layouts.backend')

@section('title')
    @lang('backend/stocks/index.stocks')
@endsection

@section('search')
    @include('backend.elements.search', [
        'url'  => route('backend.stocks.index'),
        'hint' => __('backend/stocks/index.hint'),
    ])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link' => route('backend.stocks.create'),
        'name'        => __('backend/stocks/index.create'),
    ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend/stocks/index.name')</th>
                <th>@lang('backend/stocks/index.description')</th>
                <th>@lang('backend/stocks/index.start_date')</th>
                <th>@lang('backend/stocks/index.expire_date')</th>
                <th>@lang('backend/stocks/index.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($stocks as $stock)
                <tr>
                    <td>{{ $stock->name }}</td>
                    <td>{{ Str::limit($stock->description, 50) }}</td>
                    <td>{{ $stock->start_date }}</td>
                    <td>{{ $stock->expiration_date }}</td>
                    <td>
                        @if($stock->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.stocks.edit', $stock),
                            'destroy_link' => route('backend.stocks.destroy', $stock),
                        ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="bg-warning">
                        <h3 class="text-center">@lang('backend.nothing_found')</h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7" class="text-center">
                    {{ $stocks->render() }}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection