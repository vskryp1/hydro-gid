@extends('backend.layouts.backend')

@section('title', __('backend.create_page'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_title">
            <p id="js_page_path"></p>
            <div>
                {!! Form::open([
                    'url' => route('backend.pages.store'),
                    "id" => 'needs-validation',
                    'autocomplete'=>'off',
                    'files' => true,
                    'novalidate'
                ]) !!}
                {!! Form::hidden('parent_page_id', null, ['id' => 'parent_page_id']) !!}
                @include('backend.pages.tabs.tablist')
                <div class="tab-content">
                    @include('backend.pages.tabs.base')
                    @include('backend.pages.tabs.locale')
                    @include('backend.pages.tabs.seo')
                    @include('backend.pages.tabs.parent')
                </div>
                @include('backend.elements.save_buttons', ['back_link' => route('backend.pages.index')])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div id="jstree_demo_div"></div>
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
        window.pages            = {};
        window.pages.jstreeData = {
            multiple      : true,
            enableCheckbox: true,
            pages         : [
                    @foreach($pages as $page)
                    @if ($loop->first)
                {
                    "id"     : "{{ $page->id }}",
                    "parent" : "#",
                    "text"   : "{{ $page->name }}",
                    state    : {opened: true, selected: false},
                    type     : "default",
                    draggable: 'false'
                },
                    @else
                {
                    "id"    : "{{ $page->id }}",
                    "parent": "@if(!empty($page->parent_page_id)){{ $page->parent_page_id }}@else#@endif",
                    "text"  : "{{ $page->name }}", state: {opened: true, selected: false},
                },
                @endif
                @endforeach
            ]
        };
    </script>
    {{ Html::script('assets/backend/modules/jstree/dist/jstree.js') }}
    {{ Html::script(mix('assets/backend/js/pages/jstree_init.js')) }}
    {{ Html::script(mix('assets/backend/js/pages/create.js')) }}
    {{ Html::script(mix('assets/backend/js/product.js')) }}
    {{ Html::script('assets/backend/modules/iCheck/icheck.min.js') }}
@endsection

