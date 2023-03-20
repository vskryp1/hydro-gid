@extends('backend.layouts.backend')

@section('title')
    @lang('backend.templates')
@endsection

@section('content')
@include('backend.elements.create_button', [
                'create_link'  => route('backend.mail.templates.create'),
                'name'         => __('backend.create_template'),
])
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th width="70%">@lang('backend.name')</th>
            <th width="30%"></th>
        </tr>
        </thead>
        <tbody>
        @forelse($templates as $template)
            <tr>
                <td>{{ ($template->translate()) ? $template->translate()->name : '' }}</td>
                <td>
                    @include('backend.elements.edit_buttons', [
                                'edit_link'    => route('backend.mail.templates.edit',['template'=> $template]),
                                'destroy_link' => route('backend.mail.templates.destroy',['template' => $template]),
                            ])
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="bg-warning">
                    <h3 class="text-center">
                        @lang('backend.no_items')
                    </h3>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
