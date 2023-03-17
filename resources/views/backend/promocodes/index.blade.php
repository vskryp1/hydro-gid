@extends('backend.layouts.backend')

@section('title')
    @lang('backend.promocodes')
@endsection

@section('search')
@endsection

@section('content')
    @include('backend.elements.create_button', [
                    'create_link'  => route('backend.promocodes.create'),
                    'name'         => __('backend.create_promocode'),
        ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.promocode')</th>
                <th>@lang('backend.used')</th>
                <th>@lang('backend.use_count')</th>
                <th>@lang('backend.actual')</th>
                <th>@lang('backend.active')</th>
                <th>@lang('backend.day_left')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($promocodes as $promocode)
                <tr>
                    <td>{{ $promocode->alias }}</td>
                    <td>{{ $promocode->used }}</td>
                    <td>{{ $promocode->type_of_use ? __('backend.unlimited') : $promocode->use_count }}</td>
                    <td class="text-uppercase">
                        @if($promocode->active && ($promocode->use_count > $promocode->used || $promocode->type_of_use) && $promocode->expiration_date >= \Carbon\Carbon::now()->format(config('app.formats.php.date')))
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-uppercase">
                        @if($promocode->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>{{ ($promocode->expiration_date >= \Carbon\Carbon::now()->format(config('app.formats.php.date'))) ? \Carbon\Carbon::createFromFormat('Y-m-d', $promocode->expiration_date)->diffInDays(\Carbon\Carbon::now()) : 0 }}</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.promocodes.edit', ['promocode' => $promocode]),
                                        'destroy_link' => route('backend.promocodes.destroy', ['promocode' => $promocode]),
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
    </div>

@endsection
