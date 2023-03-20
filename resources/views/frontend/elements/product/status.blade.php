@if($product->status)
    <div class="prod-cart__status">
        <div class="prod-cart__status-box {{ $product->status->class }}"
             @if($product->status->color) style="background:{{ $product->status->color }};" @endif>
                    <span>
                        {{ $product->status->name }}
                    </span>
        </div>
    </div>
@endif