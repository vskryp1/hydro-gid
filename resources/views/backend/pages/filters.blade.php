@extends('backend.layouts.backend')

@section('title', __('backend.filter_page'). ' ' . $page->name)
@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <a href="{{route('backend.pages.reset.filters.sort', $page)}}" class="btn btn-danger text-uppercase pull-right"><i
                    class="fa fa-remove"></i> @lang('backend.reset_sort')</a>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open(array('url' => route('backend.pages.filters.update', $page),'method' => 'POST')) !!}
        <div class="table-responsive">
            <table class="table-index table table-striped">
                <thead>
                <tr>
                    <th width="1%"><i class="fa fa-sort-numeric-asc"></i></th>
                    <th width="14%">@lang('backend.name')</th>
                    <th width="5%">@lang('backend.type')</th>
                    <th width="20%">@lang('backend.categories')</th>
                    <th width="10%">@lang('backend.is_characteristic')</th>
                    <th width="10%">@lang('backend.is_short')</th>
                    <th width="10%">@lang('backend.is_open')</th>
                    <th width="10%" class="text-center">@lang('backend.active')</th>
                    <th width="20%"></th>
                </tr>
                </thead>
                <tbody id="category_sorts">
                @forelse($filters as $filter)
                    <tr>
                        <td>
                            {{Form::hidden("filters[$filter->id][position]", $filter->pivot->position, ['class'=>'js_position'])}}
                            <div class="">
                                <i class="fa fa-arrows-v"></i>
                            </div>
                        </td>
                        <td>{{ $filter->name }}</td>
                        <td>{{ $filter->filter_type->name }}</td>
                        <td>{{implode(', ', $filter->pages->pluck('name')->toArray())}}</td>
                        <td>
                            {{Form::select("filters[$filter->id][is_characteristic]", [0 => __('backend.no'), 1 => __('backend.yes')], $filter->pivot->is_characteristic, ['class'=>'form-control'])}}
                        </td>
                        <td>
                            {{Form::select("filters[$filter->id][is_short]", [0 => __('backend.no'), 1 => __('backend.yes')], $filter->pivot->is_short, ['class'=>'form-control'])}}
                        </td>
                        <td>
                            {{Form::select("filters[$filter->id][is_open]", [0 => __('backend.no'), 1 => __('backend.yes')], $filter->pivot->is_open, ['class'=>'form-control'])}}
                        </td>
                        <td class="text-center text-uppercase">
                            @if($filter->active)
                                <span class="label label-success">@lang('backend.yes')</span>
                            @else
                                <span class="label label-danger">@lang('backend.no')</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @can('edit filters')
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <a href="{{route('backend.filters.edit', ['filter'=> $filter])}}"
                                       class="btn btn-sm btn-primary text-uppercase pull-right">
                                        <i class="fa fa-edit"></i>
                                        <span class="hidden-xs hidden-sm hidden-md">@lang('backend.edit')</span>
                                    </a>
                                    <a href="{{route('backend.pages.filter_values', ['page' => $page->id, 'filter' => $filter->id])}}"
                                       class="btn btn-sm btn-default text-uppercase pull-right"><i
                                                class="fa fa-sort"></i> @lang('backend.filter_values')</a>
                                </div>
                            @endcan
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
                'back_link' => route('backend.pages.edit', ['page' => $page->id]),
            ])
        <br>
        <br>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    {{ Html::script(mix('assets/backend/js/category_sort.js')) }}
@endsection