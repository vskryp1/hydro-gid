@extends('backend.layouts.backend')

@section('title', __('backend.deliveries'))

@section('search')
    {!! Form::open(['url' => route('backend.deliveries.index'), 'method' => 'GET']) !!}
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="@lang('backend.search')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">@lang('backend.go')</button>
                </span>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('content')
    @include('backend.elements.create_button', [
                        'create_link'  => route('backend.deliveries.create'),
                        'name'         => __('backend.create_delivery'),
            ])
    <div class="table-responsive">
        <table class="table-index table table-striped">
            <thead>
            <tr>
                <th width="15%">@lang('backend.name')</th>
                <th width="15%">@lang('backend.description')</th>
                <th width="10%">@lang('backend.position')</th>
                <th width="10%">@lang('backend.active')</th>
                <th width="10%">@lang('backend.default')</th>
                <th width="10%">@lang('backend.type')</th>
                <th width="10%">@lang('backend.default_price')</th>
                <th width="20%"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($deliveries as $delivery)
                <tr>
                    <td>{{ $delivery->name }}</td>
                    <td>{{ $delivery->description ? substr($delivery->description, 0, 50) : '-' }}</td>
                    <td>{{ $delivery->position }}</td>
                    <td>
                        @if($delivery->is_active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>
                        @if($delivery->is_default)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>{{ $delivery->type->description }}</td>
                    <td>{{ ShopHelper::price_format($delivery->original_price, true) }} {{ $delivery->currency->sign }}</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.deliveries.edit', ['uuid' => $delivery->id]),
                                        'destroy_link' => route('backend.deliveries.destroy', ['uuid' => $delivery->id]),
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
        </table>
    </div>
@endsection