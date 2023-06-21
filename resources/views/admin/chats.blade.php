@extends('layouts.admin')
@section('content')
    <chats-page :types="{{ json_encode($types) }}"></chats-page>
@endsection
