<div class="form-group">
    <label>{{$filter->name}} ({{$filter->filter_type->name}})</label>
    @if($filter->is_option)
        <span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> @lang('backend.cart_option')</span>
    @endif
    {!! Form::select('filters['.$filter->id.'][]',
        $filter_values,
        old('filters['.$filter->id.']')??$product_values??[],
        ($filter->is_option && config('app.group_products', false) ? [
            'class'=>'filter_select2',
            'required' => "required",
            'placeholder' => __('backend.select_placeholder'),
        ] : [
            'class'=>'filter_select2'
        ])
    )!!}
</div>