@extends('backend.layouts.backend')

@section('title', __('backend.reviews_edit'))

@section('content')
    <div class="panel">
        <div class="panel-default">
            <div class="panel-body">
                {!! Form::model($review, [
                    'route'  => ['backend.reviews.update', $review],
                    'method' => 'PUT',
                ]) !!}
                @include('backend.reviews.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Backend\Review\SaveFormRequest') !!}
@endsection