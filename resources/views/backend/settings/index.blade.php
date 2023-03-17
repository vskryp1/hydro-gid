@extends('backend.layouts.backend')

@section('title', __('backend.settings'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.settings.regions.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
            'create_link'  => route('backend.settings.global.create'),
            'name'         => __('backend.create_settings'),
])
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>@lang('backend.key')</th>
                <th>@lang('backend.description')</th>
                <th>@lang('backend.value')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($settings as $setting)
                <tr>
                    <td>{{ $setting->first()->key }}</td>
                    <td>@lang("backend/settings/index.{$setting->first()->key}")</td>
                    <td>{!! $setting->first()->value !!}  </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                      'edit_link'    => route('backend.settings.global.edit', ['id'=> $setting->first()->key]),
                                      'destroy_link' => ($setting->first()->can_delete) ? route('backend.settings.global.destroy', ['id'=> $setting->first()->key]) : null,
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
    </div>

@endsection


@section('scripts')


@endsection
