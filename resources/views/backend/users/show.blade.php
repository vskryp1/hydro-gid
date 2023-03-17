@extends('backend.layouts.backend')

@section('title', __('backend.show_user'))

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-3"></div>
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6">
                <div class="bgc-white p-20 bd">
                    <div class="table-responsive">
                        <table class="table table-small table-bordered table-sm">
                            <tr>
                                <th>@lang('backend.first_name')</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>@lang('backend.email')</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>@lang('backend.phone')</th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>@lang('backend.role')</th>
                                <td>{{  implode(', ', $user->getRoleNames()->toArray()) }}</td>
                            </tr>
                            <tr>
                                <th>@lang('backend.active')</th>
                                <td>@if($user->active)
                                        <span class="label label-success">@lang('backend.yes')</span>
                                    @else
                                        <span class="label label-default">@lang('backend.no')</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    @can('edit admins')
                        <a href="{{ route('backend.users.edit',['user'=> $user]) }}" class="btn btn-sm btn-primary text-uppercase">
                            <span class="glyphicon glyphicon-pencil"></span>
                            @lang('backend.edit')
                        </a>
                    @endcan
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection