@extends('backend.layouts.backend')

@section('title', __('backend.orders'))

@section('search')
    @include('backend.elements.search', [ 'url' => route('backend.orders.order_buy_click')])
@endsection

@section('content')
    @include('backend.orders.one click orders.table')
@endsection