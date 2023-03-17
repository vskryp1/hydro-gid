@extends('backend.layouts.backend')

@section('title')
    @lang('backend.currencies')
@endsection

@section('content')
    @include('backend.elements.create_button', [
                'create_link'  => route('backend.settings.currencies.create'),
                'name'         => __('backend.currency_create'),
            ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.code')</th>
                <th>@lang('backend.title')</th>
                <th class="text-center">@lang('backend.sign')</th>
                <th class="text-center">@lang('backend.active')</th>
                <th class="text-center">@lang('backend.default')</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @forelse($currencies_list as $currency)
                <tr>
                    <td>{{ $currency->code }}</td>
                    <td>{{ $currency->name }}</td>
                    <td class="text-center">{{ $currency->sign }}</td>
                    <td class="text-center">@if($currency->active)
                            <div class="label label-success">@lang('backend.yes')</div> @else
                            <div class="label label-danger">@lang('backend.no')</div> @endif</td>
                    <td class="text-center">@if($currency->default)
                            <div class="label label-success">@lang('backend.yes')</div> @else
                            <div class="label label-danger">@lang('backend.no')</div> @endif</td>
                    <td class="text-right">
                        @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.settings.currencies.edit', ['currency' => $currency->id]),
                                        'destroy_link' => route('backend.settings.currencies.destroy', ['currency' => $currency->id]),
                                ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="bg-warning">
                        <h3 class="text-center">
                            @lang('backend.nothing_found')
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
                <h2><i class="fa fa-money"></i> @lang('backend.courses_current')</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                <div class="col-md-5 col-md-offset-3">
                    @can('actual courses')
                        <div class="text-center">
                            <a href="{{ route('backend.settings.currencies.actual.courses') }}"
                               class="btn btn-primary btn-sm1 btn-icon icon-left " style="    margin-bottom: 10px;">
                                <i class="fa fa-refresh"></i>
                                @lang('backend.actual_course')
                            </a>
                            <i class="fa fa-info-circle"
                                                       data-toggle="tooltip"
                                                       data-original-title="@lang('backend.currencylayer_info')"></i>
                        </div>
                    @endcan
                </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width:40%">@lang('backend.currency')</th>
                        <th style="width:20%">@lang('backend.course')</th>
                        <th style="width:40%">@lang('backend.datetime')</th>
                    </tr>
                    </thead>

                    <tbody class="middle-align profile-env">
                    @forelse($currents as $current)
                        <tr>
                            <td>{{ $current->name }} ({{ $current->code }})</td>
                            <td>@if($current->course){{ round($current->course->course, 6) }}@else
                                    <div class="label label-danger">@lang('backend.no_data')</div> @endif</td>
                            <td>@if($current->course){{ \Carbon\Carbon::parse($current->course->created_at)->format(config('app.formats.php.datetime')) }}@else
                                    - @endif</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="bg-warning">
                                <h3 class="text-center">
                                    @lang('backend.nothing_found')
                                </h3>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_title">
                <h2><i class="fa fa-history"></i> @lang('backend.courses_history')</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="text-center">
                            {!! Form::open(['url' => route('backend.settings.currencies.index'), 'method' => 'GET','autocomplete' => 'off']) !!}
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                        {!! Form::text('date', request()->get('date')??date(config('app.formats.php.date')), [
                                        'class' => 'form-control has-feedback-left daterange js_submit',
                                        'data-format' => config('app.formats.js.date'),
                                        'data-start-date' => request()->get('date')??date(config('app.formats.php.date')),
                                        'data-end-date' => date(config('app.formats.php.date'))
                                        ]) !!}
                                        <span class="fa fa-calendar-o form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="width:40%">@lang('backend.currency')</th>
                        <th style="width:20%">@lang('backend.course')</th>
                        <th style="width:40%">@lang('backend.datetime')</th>
                    </tr>
                    </thead>

                    <tbody class="middle-align profile-env">
                    @forelse($courses as $course)
                        <tr>
                            <td>{{ $course->currency->name }} ({{ $course->currency->code }})</td>
                            <td>{{ round($course->course, 6) }}</td>
                            <td>{{ \Carbon\Carbon::parse($course->created_at)->format(config('app.formats.php.datetime')) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="bg-warning">
                                <h3 class="text-center">
                                    @lang('backend.nothing_found')
                                </h3>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection