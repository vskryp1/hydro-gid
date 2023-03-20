@if($order->status_new)
    {{ Form::open(['url' => route('backend.orders.feedback_viewed', ['order' => $order]), 'method' => 'POST']) }}
    <button type="submit" class="btn btn-small btn-warning">
        <i class="fa fa-success"></i>
        <span class="hidden-xs hidden-sm hidden-md">
            @lang('backend.new')
        </span>
    </button>
    {{ Form::close() }}
@else
    <span class="text-success">
        <i class="fa fa-check"></i>
        <span class="hidden-xs hidden-sm hidden-md">
            @lang('backend.showed')
        </span>
    </span>
@endif