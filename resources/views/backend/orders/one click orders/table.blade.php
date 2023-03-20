<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr role="row">
            <th width="10%">@lang('backend.date')</th>
            <th>@lang('backend.client')</th>
            <th width="20%">@lang('backend.phone')</th>
            <th width="30%">@lang('backend.products')</th>
            <th width="10%">@lang('backend.status')</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr role="row">
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td><a href="{{ $order->product->alias }}">{{ $order->product->name }}</a></td>
                <td>
                    @include('backend.elements.status-btn')
                </td>
        @empty
            <tr>
                <td colspan="8" class="bg-warning">
                    <h3 class="text-center">
                        @lang('backend.nothing_found')
                    </h3>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $orders->links('backend.elements.pagination') }}
</div>