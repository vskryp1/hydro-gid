@extends('backend.layouts.backend')

@section('title', __('backend.menu_edit'))

@section('content')

<div class="panel panel-default user-panel panel-flat">
        <div class="panel-body">
            {!! Form::model($menu , [
                'url' => route('backend.menus.update',
                ['menu' => $menu->id]),
                'method'=>'PUT',
                'autocomplete'=>'off',
                'class'=>'form-horizontal form-label-left'
            ]) !!}
                @include('backend.menus.fields')
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style('assets/backend/modules/jstree/dist/themes/default/style.min.css') }}
@endsection

@section('scripts')
    <script>
        window.pages = {};
        @if(isset($menuItems))
            window.pages.jstreeData = {
                sort_pages_url: '{{ route('backend.menus.menu_items.update.sort',['menu'=> $menu]) }}',
                multiple      : false,
                enableCheckbox: false,
                edit_url      : '{{ route('backend.menus.menu_items.edit', ['menu'=> $menu, 'menu_item' => 'menu_item']) }}',
                token         : '{{ csrf_token() }}',
                pages         : [
                    {
                        "id": "root",
                        "parent": "#",
                        "text": "{{$menu->alias}}",
                        state: {opened: true, selected: false},
                        type: "default",
                        draggable: false,
                    },
                        @foreach($menuItems as $menu_item)
                    {
                        "id"    : "{{ $menu_item->id }}",
                        "parent": "@if(!empty($menu_item->menu_item_id)){{ $menu_item->menu_item_id }}@else{{'root'}}@endif",
                        "text"  : "{{ $menu_item->menuable->name??$menu_item->name }}", state: {opened: true, selected: false},
                    },
                    @endforeach
                ]
            };
        @endif
    </script>
    {{ Html::script('assets/backend/modules/jstree/dist/jstree.js') }}
    {{ Html::script(mix('assets/backend/js/menus.js')) }}
@endsection

