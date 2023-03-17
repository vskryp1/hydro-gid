@extends('backend.layouts.backend')

@section('title', __('backend.orders'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.orders.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link'  => route('backend.orders.create'),
        'name'         => __('backend.order_create_new'),
    ])
    @include('backend.orders.table')
@endsection