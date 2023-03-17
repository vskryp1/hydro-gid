@extends('backend.layouts.backend')

@section('title', __('backend.payments'))

@section('search')
    {!! Form::open(['url' => route('backend.payments.index'), 'method' => 'GET']) !!}
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
                <input class="form-control"
                       type="text"
                       name="search"
                       value="{{ request('search') }}"
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
                        'create_link'  => route('backend.payments.create'),
                        'name'         => __('backend.create_payment'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th>@lang('backend.position')</th>
                <th>@lang('backend.active')</th>
                <th>@lang('backend.default')</th>
                <th>@lang('backend.type')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>{{ $payment->name }}</td>
                    <td>{{ $payment->position }}</td>
                    <td>
                        @if($payment->is_active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>
                        @if($payment->is_default)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>{{ $payment->type->description }}</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.payments.edit', ['uuid' => $payment->id]) ,
                                        'destroy_link' => route('backend.payments.destroy', ['uuid' => $payment->id]),
                                ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="bg-warning">
                        <h3 class="text-center">@lang('backend.nothing_found')</h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection