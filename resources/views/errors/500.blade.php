@extends('frontend.layout')

@section('title', 500)

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/404-page.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')

    <main class="page-500">
        <div class="container">
            <div class="content">
                <div class="title">Something went wrong.</div>
                @if(app()->bound('sentry') && !empty(Sentry::getLastEventID()))
                    <div class="subtitle">Error ID: {{ Sentry::getLastEventID() }}</div>
                    <script src="https://cdn.ravenjs.com/3.3.0/raven.min.js"></script>
                    <script>
                        Raven.showReportDialog({
                            eventId: '{{ Sentry::getLastEventID() }}',
                            dsn    : '{{ env('SENTRY_LARAVEL_DSN') }}'
                            @if(auth('web')->check())
                            , user: {
                                'name' : '{{ auth('web')->user()->name }}',
                                'email': '{{ auth('web')->user()->email }}',
                            }
                            @endif
                        });
                    </script>
                @endif
            </div>
        </div>
    </main>

@endsection