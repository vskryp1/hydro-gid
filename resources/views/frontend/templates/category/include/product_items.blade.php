@forelse($products as $product)
    @include('frontend.templates.category.include.product_item')
@empty
    @lang('frontend.nothing_found')
@endforelse