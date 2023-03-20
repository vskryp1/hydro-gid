@extends('backend.layouts.backend')

@section('title', __('backend.reviews_create'))

@section('content')
    <div class="panel">
        <div class="panel-default user-panel panel-flat">
            <div class="panel-body ">
                {!! Form::open([
                    'route'  => 'backend.reviews.store',
                    'method' => 'POST',
                ]) !!}
                @include('backend.reviews.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Review\SaveFormRequest') !!}
    <script>
        window.custom_var = {
            product_search_url: '{{route('backend.products.search')}}',
            page_search_url: '{{route('backend.pages.search')}}',
            search_url: '{{route('backend.products.search')}}',
            currency: '{{ ShopHelper::current_currency()->id }}'
        };
    </script>
    {{ Html::script(mix('assets/backend/js/review.js')) }}
@endsection