@extends('backend.layouts.backend')

@section('title', __('backend.edit_page'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::model($page, [
            'url' => route('backend.pages.update', ['page' => $page]),
            "id" => 'needs-validation',
            'method'=>'PUT',
            'autocomplete'=>'off',
            'files' => true,
            'novalidate'
         ]) !!}
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            @include('backend.pages.tabs.tablist')
            <div class="tab-content">
                @include('backend.pages.tabs.base')
                @include('backend.pages.tabs.add-fields')
                @include('backend.pages.tabs.locale')
                @include('backend.pages.tabs.seo')
                @include('backend.pages.tabs.parent')
            </div>
            @include('backend.elements.save_buttons', [
                'back_link'       => route('backend.pages.index'),
                'show_link'       => $urls,
                'destroy_link'    => route('backend.pages.destroy', ['page' => $page->id]),
                'permission'      => 'pages',
                'products_link' => $page->page_template->folder != 'service' ? route('backend.pages.products', ['page' => $page->id]) : ''
            ])
            {!! Form::hidden('parent_page_id', $parent_id = $page->parent_page_id,['id' => 'parent_page_id']) !!}
            {!! Form::close() !!}
            <br>
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style('assets/backend/modules/jstree/dist/themes/default/style.min.css') }}
    {{ Html::style(mix('assets/backend/css/products.css')) }}
    {{ Html::style('assets/backend/modules/iCheck/skins/flat/green.css') }}
@endsection
@section('scripts')
    {!! JsValidator::formRequest('\App\Http\Requests\Backend\Page\PageRequest')->ignore('') !!}
    <script>
        window.custom_var = {
            search_placeholder: '@lang('backend.search_for')',
        };
        window.pages = {};
        window.pages.jstreeData = {
            multiple: true,
            enableCheckbox: true,
            pages: [
                    @foreach($pages as $page)
                    @if ($loop->first)
                {
                    "id": "{{ $page->id }}",
                    "parent": "#",
                    "text": "{{ $page->name }}",
                    state: {opened: true, selected: @if($page->id == $parent_id) true @else false @endif },
                    type: "default",
                    draggable: 'false'
                },
                    @elseif($page->parent_page_id != $page->id)
                {
                    "id": "{{ $page->id }}",
                    "parent": "@if(!empty($page->parent_page_id)){{ $page->parent_page_id }}@else#@endif",
                    state: {opened: true, selected: @if($page->id == $parent_id) true @else false @endif },
                    "text": "{{ $page->name }}",
                },
                @endif
                @endforeach
            ]
        };
    </script>
    {{ Html::script('assets/backend/modules/jstree/dist/jstree.js') }}
    {{ Html::script(mix('assets/backend/js/pages/jstree_init.js')) }}
    {{ Html::script(mix('assets/backend/js/pages/edit.js')) }}
    {{ Html::script(mix('assets/backend/js/product.js')) }}
    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
@endsection
