@extends('backend.layouts.backend')

@section('title', __('backend.dashboard'))

@section('content')
    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top">
                <i class="fa fa-user"></i>
                @lang('backend.total_clients')
            </span>
            <div class="count">
                {{ $client_count }}
            </div>
            <span class="count_bottom">
                @if($clients_last_week > 0)
                    <i class="green">
                        <i class="fa fa-sort-asc"></i>
                        {{ $clients_last_week }}
                        <i class="fa fa-percent"></i>
                    </i>
                @else
                    {{ $clients_last_week }}
                    <i class="fa fa-percent"></i>
                @endif
                @lang('backend.last_week')
            </span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count @if($clients_disabled > 0) red @endif">
            <span class="count_top">
                <i class="fa fa-user"></i>
                @lang('backend.disabled_clients')
            </span>
            <div class="count">
                {{ $clients_disabled }}
            </div>
            <span class="count_bottom">
                <i class="red">
                    <i class="fa fa-sort-desc"></i>
                    {{ $clients_disabled_percent }}
                    <i class="fa fa-percent"></i>
                </i>
                @lang('backend.of_the_total')
            </span>
        </div>
    </div>
@endsection

@section('styles')
    {!! Html::style(url('/assets/backend/css/dashboard.css')) !!}
@endsection

@section('scripts')
    {!! Html::script(url('/assets/backend/js/dashboard.js')) !!}
@endsection