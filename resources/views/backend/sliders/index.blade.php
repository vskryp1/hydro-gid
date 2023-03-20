@extends('backend.layouts.backend')

@section('title', __('backend.sliders'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.sliders.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
                    'create_link'  => route('backend.sliders.create'),
                    'name'         => __('backend.slider_create'),
        ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.name')</th>
                <th>@lang('backend.alias')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th width="300px"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($sliders as $slider)
                <tr>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->alias }}</td>
                    <td class="text-center text-uppercase">
                        @if($slider->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.sliders.edit', ['slider'=> $slider]),
                                'destroy_link' => route('backend.sliders.destroy', ['slider'=> $slider]),
                                'model'        => $slider,
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
        {{ $sliders->links('backend.elements.pagination') }}
    </div>

@endsection
