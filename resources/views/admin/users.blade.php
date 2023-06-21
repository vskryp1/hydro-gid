@extends('layouts.admin')
@section('content')
    <users
        :countries="{{ json_encode($countries) }}"
        :users="{{ json_encode($users) }}"
    ></users>
@endsection
