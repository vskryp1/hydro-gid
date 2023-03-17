<tr data-product="{{$id??''}}">
    <td>
        <div class="">
            <br>
            <i class="fa fa-arrows-v"></i>
        </div>
    </td>
    <td><img width="35px" src="/cache/prod_sm/{{$cover??''}}" alt=""></td>
    <td class="js_name">{{$name??''}}</td>
    <td class="js_sku">{{$sku??''}}</td>
    <td class="">
        {!! Form::radio('parent', $id??'', $parent??false, ['class' => 'js_parent']) !!}
    </td>
    <td>
        <a target="_blank" href="{{route('backend.products.edit', $id??'')}}"
           class="btn btn-sm btn-primary text-uppercase pull-right js_edit_product">
            <i class="fa fa-edit"></i>
        </a>
    </td>
    <td>
        {!! Form::hidden('products[]', $id??'') !!}
        <button type="button" class="btn fa fa-trash-o btn-danger btn-sm js_product_remove pull-right" @if(isset($parent) && $parent) disabled @endif
                data-dialog="@lang('backend.delete_question')"></button>
    </td>
</tr>