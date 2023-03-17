@extends('backend.layouts.backend')

@section('title', __('backend.menu_items_create'))

@section('content')
    <div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::open([
                'url' => route('backend.menus.menu_items.store',
                ['menu' => $menu]),
                'method'=>'POST',
                'autocomplete'=>'off',
                'files' => true,
                'class'=>'form-horizontal form-label-left'
            ]) !!}
            {!! Form::hidden('menu_id', $menu) !!}
            @include('backend.menus.items.fields')
            @include('backend.elements.save_buttons', ['back_link' => route('backend.menus.edit', ['menu' => $menu]).'#menu_items'])

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style(mix('assets/backend/css/menu_items.css')) }}
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/menu_items.js')) }}
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Sliders\StoreSliderItemRequest')->ignore('') !!}
    <script>
        window.custom_var = {
            search_placeholder: '@lang('backend.search_for')',
            model_search_url: '{{route('backend.search.model')}}',
            models: {
        @foreach(\App\Models\Menu\MenuItem::MENU_ITEM_TYPES as $key => $model)
        {{$key}}:
        '{{ addslashes($model) }}',
        @endforeach
        }
        }
        ;
    </script>
@endsection

