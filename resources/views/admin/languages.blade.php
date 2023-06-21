@extends('layouts.admin')
@section('content')
    <languages
        :texts="{{ json_encode($texts) }}"
        :languages="{{ json_encode($languages) }}"
        :countries="{{ json_encode($countries) }}"
    ></languages>
@endsection
