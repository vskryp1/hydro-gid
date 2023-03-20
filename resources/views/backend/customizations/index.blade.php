@extends('backend.layouts.backend')

@section('title', __('backend.customizations'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.pages.customizations.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.pages.customizations.create'),
                'name'         => __('backend.customizations_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th>@lang('backend.price')</th>
                <th width="45%">@lang('backend.description')</th>
                <th class="text-center">@lang('backend.position')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($customizations as $customization)
                <tr>
                    <td>{{ $customization->name }}</td>
                    <td>{{ round($customization->price, 2) }} {{ShopHelper::default_currency()->sign}}</td>
                    <td>{{ $customization->description }}</td>
                    <td class="text-center">{{ $customization->position }}</td>

                    <td class="text-center text-uppercase">
                        @if($customization->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.pages.customizations.edit', ['customization' => $customization]),
                                        'destroy_link' => route('backend.pages.customizations.destroy', ['customization' => $customization]),
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
        {{ $customizations->links('backend.elements.pagination') }}
    </div>

@endsection
