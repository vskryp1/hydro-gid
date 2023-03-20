@extends('backend.layouts.backend')

@section('title', __('backend.filter_value_page'). ' ' . $page->name . ' - '. $filter->name)
@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <a href="{{route('backend.pages.reset.filter_values.sort', [$page, $filter])}}"
           class="btn btn-danger text-uppercase pull-right"><i
                    class="fa fa-remove"></i> @lang('backend.reset_default')</a>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open(array('url' => route('backend.pages.filter_values.update', [$page, $filter]),'method' => 'POST')) !!}
        <div class="table-responsive">
            <table class="table-index table table-striped">
                <thead>
                <tr>
                    <th width="1%"><i class="fa fa-sort-numeric-asc"></i></th>
                    <th width="15%">@lang('backend.name')</th>
                    <th width="15%">@lang('backend.is_open')</th>
                    <th width="10%" class="text-center">@lang('backend.active')</th>
                    <th width="2%"></th>
                </tr>
                </thead>
                <tbody id="category_sorts">
                @forelse($filter_values as $filter_value)
                    <tr>
                        <td>
                            {{Form::hidden("filter_values[$filter_value->id][position]", $filter_value->position??$loop->iteration, ['class'=>'js_position'])}}
                            <div class="">
                                <br>
                                <i class="fa fa-arrows-v"></i>
                            </div>
                        </td>
                        <td>{{ $filter_value->name }}</td>

                        <td>
                            {{Form::select("filter_values[$filter_value->id][is_open]", [0 => __('backend.no'), 1 => __('backend.yes')], $filter_value->is_open, ['class'=>'form-control'])}}
                        </td>
                        <td class="text-center text-uppercase">
                            @if($filter_value->active)
                                <span class="label label-success">@lang('backend.yes')</span>
                            @else
                                <span class="label label-danger">@lang('backend.no')</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @include('backend.elements.edit_buttons', [
                                    'edit_link'    => route('backend.filters.values.edit', ['filter'=> $filter, 'values' => $filter_value]),
                                    'permission'   => 'filters'
                            ])
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="bg-warning">
                            <h3 class="text-center">
                                @lang('backend.nothing_found')
                            </h3>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @include('backend.elements.save_buttons', [
                'back_link' => route('backend.pages.filters', ['page' => $page->id]),
            ])
        <br>
        <br>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/category_sort.js')) }}
@endsection