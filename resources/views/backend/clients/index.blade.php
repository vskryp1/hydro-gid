@extends('backend.layouts.backend')

@section('title', __('backend.clients'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.clients.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'name'         => __('backend.create_client'),
        'create_link'  => route('backend.clients.create'),
    ])
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>@lang('backend.first_name')</th>
                <th>@lang('backend.last_name')</th>
                <th>@lang('backend.email')</th>
                <th>@lang('backend.phone')</th>
                <th>Юридическая информация</th>
                <th>@lang('backend.is_active')</th>
                <th>@lang('backend.percent')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($clients as $client)
                <tr @if($client->deleted_at) class="danger" @endif>
                    <td>{{ $client->first_name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    @if($client->is_legal_entity)
                        <td>
                            <strong>@lang('backend.company_name'):</strong>
                            {{ $client->company_name ?? '-' }}
                            <br>
                            <strong>@lang('backend.edrpou'):</strong>
                            {{ $client->edrpou ?? '-' }}
                        </td>
                    @else
                        <td>
                            <div class="label label-info text-uppercase">
                                @lang('backend.does_not_exists')
                            </div>
                        </td>
                    @endif
                    <td>
                        @if($client->is_active)
                            <div class="label label-success text-uppercase">
                                @lang('backend.yes')
                            </div>
                        @else
                            <div class="label label-danger text-uppercase">
                                @lang('backend.no')
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($client->discount)
                            @if($client->is_percentage)
                                <div class="label label-success text-uppercase">
                                    {{ $client->discount . '%'}}
                                </div>
                            @else
                                <div class="label label-warning text-uppercase">
                                    {{ $client->discount . ' грн'}}
                                </div>
                            @endif
                        @else
                            <div class="label label-default text-uppercase">
                                0
                            </div>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.clients.edit',['client'=> $client]),
                            'destroy_link' => route('backend.clients.destroy', ['client'=> $client]),
                            'restore_link' => route('backend.clients.restore', ['client'=> $client]),
                            'model'        => $client,
                        ])
                    </td>
                </tr>
            @empty
                <tr class="warning">
                    <td colspan="7">
                        <h4 class="text-center">
                            @lang('backend.nothing_found')
                        </h4>
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="7">
                    {!! $clients->render('backend.elements.pagination') !!}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection