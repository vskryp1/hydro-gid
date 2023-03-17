@extends('backend.layouts.backend')

@section('title', __('backend/service/index.service_order'))

@section('search')
    @include('backend.elements.search', ['url' => route('backend.service-orders.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link'  => route('backend.service-orders.create'),
        'name'         => __('backend/service/index.create'),
    ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>{{ __('backend/service/index.type') }}</th>
                <th width="10%">{{ __('backend/service/index.service') }}</th>
                <th>{{ __('backend/service/index.username') }}</th>
                <th>{{ __('backend/service/index.email') }}</th>
                <th>{{ __('backend/service/index.phone') }}</th>
                <th>{{ __('backend/service/index.comment') }}</th>
                <th width="10%">{{ __('backend/service/index.call_me') }}</th>
                <th width="8%">{{ __('backend/service/index.active') }}</th>
                <th>{{ __('backend/service/index.date') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($serviceOrders as $serviceOrder)
                <tr>
                    <td>{{ $serviceOrder->type->getDesc() }}</td>
                    <td>{{ $serviceOrder->type->is(ServiceType::ORDER) ? $serviceOrder->page->name : '-' }}</td>
                    <td>{{ $serviceOrder->username }}</td>
                    <td>{{ $serviceOrder->email }}</td>
                    <td>{{ $serviceOrder->phone }}</td>
                    <td>{{ Str::limit($serviceOrder->comment, 50) }}</td>
                    <td>
                        @if($serviceOrder->call_me)
                            <span class="label label-success">{{ __('backend.yes') }}</span>
                        @else
                            <span class="label label-danger">{{ __('backend.no') }}</span>
                        @endif
                    </td>
                    <td>
                        @if($serviceOrder->active)
                            <span class="label label-success">{{ __('backend.yes') }}</span>
                        @else
                            <span class="label label-danger">{{ __('backend.no') }}</span>
                        @endif
                    </td>
                    <td>{{ Carbon::parse($serviceOrder->created_at)->format(config('app.formats.php.date'))}}</td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                             'edit_link'    => route('backend.service-orders.edit', $serviceOrder),
                             'destroy_link' => route('backend.service-orders.destroy', $serviceOrder),
                         ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        <h3 class="text-center">
                            <i class="fa fa-info"></i>
                            {{ __('backend.nothing_found') }}
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
            @isset($serviceOrders)
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="text-center">
                            {!! $serviceOrders->render('backend.elements.pagination') !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            @endisset
        </table>
    </div>
@endsection