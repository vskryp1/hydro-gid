@include('backend.elements.create_button', [
       'create_link'  => route('backend.products.warranty.create', $product),
       'name'         => __('backend/product/index.warranty_create_new'),
   ])
<div class="table-responsive">
    <table class="table-index table table-striped">
        <thead>
        <tr>
            <th width="20%">@lang('backend/product/index.amount_of_time')</th>
            <th width="20%">@lang('backend.price')</th>
            <th width="20%">@lang('backend.position')</th>
            <th width="10%">@lang('backend.active')</th>
            <th width="30%"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($product->warranties as $warranty)
            <tr>
                <td>{{ $warranty->amount }}</td>
                <td>{{ $warranty->price_formatted }} @lang('backend/product/index.uah')</td>
                <td>{{ $warranty->position }}</td>
                <td>
                    @if($warranty->active)
                        <span class="label label-success">@lang('backend.yes')</span>
                    @else
                        <span class="label label-danger">@lang('backend.no')</span>
                    @endif
                </td>
                <td class="text-right">
                    @include('backend.elements.edit_buttons', [
                        'edit_link'    => route('backend.products.warranty.edit', [$product, $warranty]),
                        'destroy_link' => route('backend.products.warranty.destroy', [$product, $warranty]),
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