@extends('backend.layouts.backend')

@section('title', __('backend.backup'))

@section('content')

    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
                   aria-controls="home" aria-selected="true">
                    @lang('backend.base') </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" data-tab="#settings" role="tab"
                   aria-controls="settings" aria-selected="true">
                    @lang('backend.settings') </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active in" id="base" role="tabpanel"
                 aria-labelledby="home-tab">
                <div>
                    <a href="{{ route('backend.settings.backups.make') }}"
                       class="btn btn-sm btn-success text-uppercase">
                        <i class="fa fa-hdd-o"></i>
                        @lang('backend.make_backup')
                    </a>
                    <a href="{{ route('backend.settings.backups.clear') }}"
                       class="btn btn-sm btn-success text-uppercase">
                        <i class="fa fa-trash"></i>
                        @lang('backend.clear_backup')
                    </a>
                </div>
                <table class="table-index table table-striped">
                    <thead>
                    <tr>
                        <th width="15%">@lang('backend.number')</th>
                        <th width="30%">@lang('backend.name')</th>
                        <th width="40%">@lang('backend.datetime')</th>
                        <th width="5%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($backup_list as $number => $backup_one)
                        <tr>
                            <td>{{ $number+1 }}</td>
                            <td>{{ basename($backup_one) }}</td>
                            <td>{{\Carbon\Carbon::createFromTimestamp(File::lastModified(Storage::path($backup_one)))->toDateTimeString()}} ({{ \Carbon\Carbon::createFromTimestamp(File::lastModified(Storage::path($backup_one)))->diffForHumans() }})</td>
                            <td><a href="{{route('backend.settings.backups.download', $number)}}" class="btn btn-info"><i class="fa fa-save"></i> @lang('backend.download')</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="bg-warning">
                                <h3 class="text-center">
                                    @lang('backend.nothing_found')
                                </h3>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="settings" role="tabpanel"
                 aria-labelledby="settings-tab">
                {!! Form::open(['url' => route('backend.settings.backups.store'), 'method' => 'post']) !!}
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group">
                            <label for="roleName">@lang('backend.max_backup')</label>
                            <small>@lang('backend.max_backup_info')</small>
                            {!! Form::number('max_count', old('max_count')??$backups['max_count']??7,['class'=>'form-control','placeholder'=> __('backend.max_backup'),'min'=>1]) !!}
                        </div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.time')</label>
                            <small>@lang('backend.backup_time_info')</small>
                            {!! Form::text('time',old('time')??$backups['time']??'1:00',['class'=>'form-control','placeholder'=> __('backend.time')]) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::hidden('active', 0) !!}
                            {!! Form::checkbox('active', 1, old('active')??$backups['active']??false, ['class' => 'js-switch']) !!}
                            @lang('backend.use_auto_backup')
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary text-uppercase pull-right"><i
                            class="fa fa-save"></i> @lang('backend.save')</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection


@section('scripts')


@endsection
