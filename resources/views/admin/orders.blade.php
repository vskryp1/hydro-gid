@extends('layouts.admin')
@section('content')
    <orders
        :countries="{{ json_encode($countries) }}"
        :orders="{{ json_encode($orders) }}"
        :statuses="{{ json_encode($statuses) }}"
    ></orders>
@endsection
