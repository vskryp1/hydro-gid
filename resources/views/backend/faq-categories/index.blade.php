@extends('backend.layouts.backend')

@section('title', __('backend.faq_categories'))

@section('content')
    @include('backend.elements.create_button', [
                        'create_link'  => route('backend.faqs.categories.create'),
                        'name'         => __('backend.faq_category_create'),
        ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th class="text-center">@lang('backend.position')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name}}</td>
                    <td class="text-center">{{ $category->position }}</td>
                    <td class="text-center text-uppercase">
                        @if($category->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.faqs.categories.edit',['category'=> $category]),
                            'destroy_link' => route('backend.faqs.categories.destroy',['category' => $category]),
                        ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="bg-warning">
                        <h3 class="text-center">
                            @lang('backend.nothing_found')
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $categories->links('backend.elements.pagination') }}
    </div>
@endsection
