@extends('backend.layouts.backend')

@section('title')
    @lang('backend.seo_metatags')
@endsection

@section('content')
    @include('backend.elements.create_button', [
                            'create_link'  => route('backend.seo-metas.create'),
                            'name'         => __('backend.seo_metatag_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.url')</th>
                <th>@lang('backend.title')</th>
                <th>@lang('backend.key')</th>
                <th>@lang('backend.description')</th>
                <th>@lang('backend.robots')</th>
                <th>@lang('backend.canonical')</th>
                <th>@lang('backend.content')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($metas as $meta)
                <tr>
                    <td>{{ $meta->seo_url}}</td>
                    <td>{{ $meta->seo_title}}</td>
                    <td>{{ $meta->seo_keywords}}</td>
                    <td>{{ $meta->seo_description}}</td>
                    <td>{{ $meta->seo_robots}}</td>
                    <td>{{ $meta->seo_canonical}}</td>
                    <td>{{ $meta->seo_content}}</td>
                    <td width="16%">
                        @include('backend.elements.edit_buttons', [
                                     'edit_link'    => route('backend.seo-metas.edit',['meta'=> $meta]),
                                     'destroy_link' => route('backend.seo-metas.destroy',['id' => $meta->id]),
                                 ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="bg-warning">
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