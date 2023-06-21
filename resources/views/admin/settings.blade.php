@extends('layouts.admin')
@section('content')
    <settings
        :settings="{{ json_encode($settings) }}"
    ></settings>
@endsection
