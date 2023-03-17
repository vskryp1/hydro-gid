<button data-put="{{ route('ajax.user.put.in.comparelist', [
                                                    'user_id' => auth('web')->id() ?? 'guest',
                                                    'product' => $product,
                                                ]) }}"
        data-remove="{{ route('ajax.user.remove.from.comparelist', [
                                                    'user_id' => auth('web')->id() ?? 'guest',
                                                    'row_id' => auth('web')->user() && auth('web')->user()->comparelist->firstWhere('id', $product->id)
                                                     ? auth('web')->user()->comparelist->firstWhere('id', $product->id)->rowId
                                                      : '',
                                                ]) }}"
        data-method="POST"
        class="button-reset js_toggle_in_сomparelist prod-cart__addto-box {{ isset($classes) ? implode('', $classes) : '' }}
@if(auth('web')->user() && auth('web')->user()->hasProdInCompareList($product)) active @endif">
    <i class="icon icon-balance"></i>
</button>