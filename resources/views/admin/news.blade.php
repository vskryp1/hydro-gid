@extends('layouts.admin')
@section('content')
    <news
        :articles="{{ json_encode($news) }}"
    ></news>
@endsection
