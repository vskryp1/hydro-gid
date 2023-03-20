@extends('backend.layouts.backend')

@section('title', __('backend.regions'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.settings.regions.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                        'create_link'  => route('backend.settings.regions.create'),
                        'name'         => __('backend.create_region'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th>@lang('backend.position')</th>
                <th>@lang('backend.active')</th>
                <th>@lang('backend.default')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($regions as $region)
                <tr>
                    <td>{{ $region->name }}</td>
                    <td>{{ $region->position }}</td>
                    <td>
                        @if($region->is_active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td>
                        @if($region->is_default)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                      'edit_link'    => route('backend.settings.regions.edit', ['uuid' => $region->id]),
                                      'destroy_link' => route('backend.settings.regions.destroy', ['uuid' => $region->id]),
                                ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="bg-warning">
                        <h3 class="text-center">@lang('backend.nothing_found')</h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection