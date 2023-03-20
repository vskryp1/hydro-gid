@extends('backend.layouts.backend')

@section('title', __('backend.badges'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.products.badges.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.products.badges.create'),
                'name'         => __('backend.badges_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.image')</th>
                <th>@lang('backend.name')</th>
                <th class="text-center">@lang('backend.position')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($badges as $badge)
                <tr>
                    <td>@if(isset($badge->image) && $badge->image != '') <img src="/cache/badge_md/{{$badge->image }}" width="80px"> @endif</td>
                    <td>{{ $badge->name }}</td>
                    <td class="text-center">{{ $badge->position }}</td>

                    <td class="text-center text-uppercase">
                        @if($badge->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.products.badges.edit', ['badge' => $badge]),
                                        'destroy_link' => route('backend.products.badges.destroy', ['badge' => $badge]),
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
        {{ $badges->links('backend.elements.pagination') }}
    </div>

@endsection
