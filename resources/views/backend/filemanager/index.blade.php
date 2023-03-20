@extends('backend.layouts.backend')

@section('title', __('backend.filemanager'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-body" style="height: 730px;">

            <div style="height: 600px;">
                <div id="fm"></div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection
