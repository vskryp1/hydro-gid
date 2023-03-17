@extends('backend.layouts.backend')

@section('title')
    @lang('backend.mail_templates')
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link'  => route('backend.mail.email.templates.create'),
        'name'         => __('backend.create_mail_template'),
    ])
    <div class="table-responsive ">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="50%">@lang('backend.name')</th>
                <th width="20%">@lang('backend.percent')</th>
                <th width="30%"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($mailTemplates as $mailTemplate)
                <tr>
                    <td>{{ $mailTemplate->name }}</td>
                    <td>
                        @if($mailTemplate->all == 0)
                            <div class="progress bottom">
                                <div class="progress-bar progress-bar-default" data-transitiongoal="0">1%</div>
                            </div>
                        @else
                            @if($mailTemplate->all == $mailTemplate->current)
                                <div class="progress bottom">
                                    <div class="progress-bar progress-bar-success" data-transitiongoal="100">100%</div>
                                </div>
                            @else
                                <div class="progress bottom">
                                    <div class="progress-bar progress-bar-warning" data-transitiongoal="{{ round($mailTemplate->current / $mailTemplate->all * 100) }}">{{ round($mailTemplate->current / $mailTemplate->all * 100) }}%</div>
                                </div>
                            @endif
                        @endif
                    </td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                            'edit_link'    => route('backend.mail.email.templates.edit',['template' => $mailTemplate]),
                            'destroy_link' => route('backend.mail.email.templates.destroy',['template' => $mailTemplate]),
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
        {{ $mailTemplates->links() }}
    </div>

@endsection

@section('scripts')
@endsection
