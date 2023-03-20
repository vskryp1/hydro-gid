@extends('backend.layouts.backend')

@section('title')
    @lang('backend.pages')
@endsection

@section('content')
    @include('backend.elements.create_button', [
                    'create_link'  => route('backend.pages.create'),
                    'name'         => __('backend.create_new_page'),
                    'permission'   => 'pages',
        ])
    <div class="table-responsive">
        <div id="tree_container">
            <div id="js_tree"></div>
        </div>
    </div>
@endsection

@section('styles')
    {{ Html::style('assets/backend/modules/jstree/dist/themes/default/style.min.css') }}
@endsection

@section('scripts')
    <script>
        window.pages = {};
        window.pages.jstreeData = {
            sort_pages_url: '{{ route('backend.pages.update.sort') }}',
            multiple      : false,
            enableCheckbox: false,
            edit_url      : '{{ route('backend.pages.edit', ['page' => '']) }}/',
            token         : '{{ csrf_token() }}',
            pages         : [
                    @foreach($pages as $page)
                {
                    "id"    : "{{ $page->id }}",
                    "parent": "@if(!empty($page->parent_page_id)){{ $page->parent_page_id }}@else{{'#'}}@endif",
                    "text"  : "{{ $page->name }}", state: {opened: true, selected: false},
                },
                @endforeach
            ]
        };
    </script>
    {{ Html::script('assets/backend/modules/jstree/dist/jstree.js') }}
    {{ Html::script(mix('assets/backend/js/pages/jstree_init.js')) }}
    {{ Html::script(mix('assets/backend/js/pages/index.js')) }}
@endsection
