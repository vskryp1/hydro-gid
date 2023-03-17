@extends('backend.layouts.backend')

@section('title', __('backend.import'))

@section('content')
    <div class="sorter">
        <p>
            @lang('backend.matching_database_with_file')
        </p>
        {!! Form::open([
            'route'  => 'backend.import.products',
            'method' => 'POST',
            'files'  => true,
        ]) !!}
        <div class="row">
            {!! Form::hidden('fileName', $fileName) !!}
            <div class="column left first">
                <p>
                    @lang('backend.database_fields')
                </p>
                <ul class="arr" id="dbFields">
                    @foreach($headers as $header)
                        <li>
                            {{ $header }}
                            {{ Form::hidden('header[]', $header) }}
                            <span class="fa fa-chevron-right"></span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="column left first">
                <p>
                    @lang('backend.related_file_fields')
                </p>
                <ul id="sortLeft">
                    @foreach($relatives as $relative)
                        <li>
                            {{ $relative }}
                            {{ Form::hidden('relative[]', $relative) }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="column left" style="margin-left:10px;">
                <p>
                    @lang('backend.unrelated_file_fields')
                </p>
                <ul id="sortRight">
                    @foreach($unRelatives as $unRelative)
                        <li>
                            {{ $unRelative }}
                            {{ Form::hidden('un_relative[]', $unRelative) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            {!! Form::submit(__('backend.save_continue'), [
                'class' => 'btn btn-sm btn-success'
            ]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {!! Html::script(mix('/assets/backend/js/import.js')) !!}
@endsection