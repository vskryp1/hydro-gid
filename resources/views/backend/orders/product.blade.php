<tr data-product="{{$id??''}}">
    <td>
        <button type="button" class="btn fa fa-trash-o btn-danger btn-sm js_product_remove"
                data-dialog="@lang('backend.delete_question')"></button>
    </td>
    <td><img src="{{$cover??''}}" width="40px"></td>
    <td><span class="js_name">{{$format_name??''}}</span></td>
    <td class="js_option">
        @if(config('app.group_products', false))
            {{$options??''}}
        @else
            @isset($options)
                @forelse($options as $name => $option)
                    {{$name .': '. $option}}<br>
                @empty
                    -
                @endforelse
            @endisset
        @endif
    </td>
    <td>
        {{$product->availability->description??''}}
    </td>
    <td>
        <input name="products[{{$id??''}}][options][warranty][price]"
               class="form-control js_warranty_price"
               value="{{ isset($pivot_options['warranty'])
                     ? ShopHelper::price_format($pivot_options['warranty']['price'], true)
                     : 0 }}">
    </td>
    <td>
        <input name="products[{{$id??''}}][options][warranty][amount]"
               class="form-control js_warranty_amount"
               value="{{ isset($pivot_options['warranty']) ? $pivot_options['warranty']['amount'] : 0 }}">
    </td>
    <td><input name="products[{{$id??''}}][price]" value="{{isset($price)?ShopHelper::price_format($price, true):''}}"
               type="number"
               step="0.01"
               min="0.01" class="form-control js_price" title=""/></td>
    <td><input name="products[{{$id??''}}][qty]" value="{{$qty??1}}" type="number" step="1"
               min="1" class="form-control js_quantity" title=""></td>
    <td>
        <b>
            <h5>
                <span class="js_sub_total"></span>
            </h5>
        </b>
    </td>
</tr>