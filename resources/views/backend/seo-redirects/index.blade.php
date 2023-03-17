@extends('backend.layouts.backend')

@section('title', __('backend.redirects'))

@section('content')
    @include('backend.elements.create_button', [
                            'create_link'  => route('backend.seo-redirects.create'),
                            'name'         => __('backend.redirect_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.status_code')</th>
                <th>@lang('backend.from_desc')</th>
                <th>@lang('backend.to_desc')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($redirects as $redirect)
                <tr>
                    <td width="10%">{{ $redirect->status_code}}</td>
                    <td width="32%">{{ $redirect->from }}</td>
                    <td width="30%">{{ $redirect->to }}</td>
                    <td width="16%">
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.seo-redirects.edit',['redirect'=> $redirect]),
                            'destroy_link' => route('backend.seo-redirects.destroy',['id' => $redirect->id]),
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
