@auth('web')
    <button data-put="{{ route('ajax.user.put.in.wishlist', ['user_id' => auth('web')->id(), 'product' => $product]) }}"
            data-remove="{{ route('ajax.user.remove.from.wishlist', [
                     'user_id' => auth('web')->id(),
                      'product' => auth('web')->user()->wishlist->firstWhere('id', $product->id)
                        ? auth('web')->user()->wishlist->firstWhere('id', $product->id)->rowId
                        : ''
                      ]) }}"
            data-method="POST"
            data-counter="js_wishlist_counter"
            data-type="{{ isset($type) ? $type : '' }}"
            data-in-wishlist="{{ (bool) auth('web')->user()->hasProductInWishList($product) }}"
            class="button-reset prod-cart__addto-box js_toggle_in_wishlist {{ isset($classes) ? implode('', $classes) : '' }}
            @if(auth('web')->user()->hasProductInWishList($product)) active @endif">
        <i class="icon icon-bookmarks"></i>
    </button>
@else
    <a href="#"
       data-fancybox data-src="#modal"
       data-type="{{ isset($type) ? $type : '' }}"
       class="button-reset prod-cart__addto-box {{ isset($classes) ? implode('', $classes) : '' }}">
        <i class="icon icon-bookmarks"></i>
    </a>
@endauth
