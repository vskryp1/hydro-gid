@extends('backend.layouts.backend')

@section('title')
    @lang('backend.roles')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            @include('backend.elements.create_button', [
                'create_link'  => route('backend.roles.create'),
                'name'         => __('backend.create_new_role')
            ])
            <div class="container">
                <div class="table-responsive">
                    <table class="table-index table table-striped">
                        <thead>
                        <tr>
                            <th width="30%">@lang('backend.name')</th>
                            <th width="30%">@lang('backend.users_attached')</th>
                            <th width="20%">@lang('backend.active')</th>
                            <th width="20%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    {{ $role->isAdminGuardName() ? $role->users_count : $role->clients_count }}
                                </td>
                                <td>
                                    @if($role->active)
                                        <span class="label label-success">
                                            @lang('backend.yes')
                                        </span>
                                    @else
                                        <span class="label label-default">
                                            @lang('backend.no')
                                        </span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.roles.edit', ['role'=> $role]),
                                        'destroy_link' => auth('admin')->user()->isSuperAdmin() && $role->name !== \App\Enums\UserType::ROLE_SUPER_ADMIN
                                            ? route('backend.roles.destroy', ['id' => $role->id])
                                            : false,
                                    ])
                                </td>
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
            </div>
        </div>
    </div>
@endsection