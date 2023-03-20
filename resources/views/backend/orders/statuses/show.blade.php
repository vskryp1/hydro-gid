@extends('backend.layouts.backend')

@section('title')
    @lang('backend.status')
@endsection

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="table-responsive">
                <table class="table table-small table-bordered table-sm">
                    <tr>
                        <th>@lang('backend.name')</th>
                        <td>{{ $status->name }}</td>
                    </tr>
                    <tr>
                        <th>@lang('backend.position')</th>
                        <td>{{ $status->position }}</td>
                    </tr>

                    <tr>
                        <th>@lang('backend.active')</th>
                        <td>
                            @if ($status->active)
                                <span class="badge badge-success">@lang('backend.yes')</span>
                            @else
                                <span class="badge badge-danger">@lang('backend.no')</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <a href="{{ route('backend.order_statuses.edit',['status'=> $status]) }}"
               class="btn btn-sm btn-primary text-uppercase">
                <span class="t-pencil"></span>
                @lang('backend.edit')
            </a>
        </div>
    </div>
@endsection