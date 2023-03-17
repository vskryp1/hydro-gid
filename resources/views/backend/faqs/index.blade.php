@extends('backend.layouts.backend')

@section('title')
    @lang('backend/faq/index.create_faq')
@endsection

@section('content')
    @include('backend.elements.create_button', [
                        'create_link'  => route('backend.faqs.create'),
                        'name'         => __('backend/faq/index.create_faq'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.position')</th>
                <th>@lang('backend/faq/index.question')</th>
                <th>@lang('backend/faq/index.answer')</th>
                <th>@lang('backend.active')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($faqs as $faq)
                <tr>
                    <td>{{ $faq->position }}</td>
                    <td>{{ $faq->question }}</td>
                    <td>{!! $faq->answer !!}</td>
                    <td>
                        @if($faq->active)
                            <span class="label label-success">@lang('backend.yes')</span>
                        @else
                            <span class="label label-danger">@lang('backend.no')</span>
                        @endif
                    </td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                      'edit_link'    => route('backend.faqs.edit', $faq),
                                      'destroy_link' => route('backend.faqs.destroy', $faq),
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
        {{ $faqs->links('backend.elements.pagination') }}
    </div>
@endsection