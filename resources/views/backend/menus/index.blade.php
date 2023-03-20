@extends('backend.layouts.backend')

@section('title', __('backend.menus'))

@section('content')
    @include('backend.elements.create_button', [
                    'create_link'  => route('backend.menus.create'),
                    'name'         => __('backend.menu_create'),
        ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.alias')</th>
                <th>@lang('backend.type')</th>
                <th>@lang('backend.page_parent')</th>
                <th width="300px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($menus as $menu)
                <tr>
                    <td>{{ $menu->alias }}</td>
                    <td>{{ __('backend.'.\App\Models\Menu\Menu::MENU_TYPES[$menu->type]) }}</td>
                    <td>@if($menu->page){{ $menu->page->name }}@else @lang('backend.no_parent_page') @endif</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.menus.edit', ['menu'=> $menu]),
                                'destroy_link' => route('backend.menus.destroy', ['menu'=> $menu]),
                                'model'        => $menu,
                        ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="bg-warning">
                        <h3 class="text-center">
                            @lang('backend.nothing_found')
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $menus->links('backend.elements.pagination') }}
    </div>
@endsection
