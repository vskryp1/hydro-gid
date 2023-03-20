@extends('backend.layouts.backend')

@section('title')
    @lang('backend.user_managment')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            @include('backend.elements.create_button', [
                            'create_link'  => route('backend.users.create'),
                            'name'         => __('backend.create_user'),
            ])
            <div class="container">
                <div class="table-responsive">
                    <table class="table-index table table-striped fa-border">
                        <thead>
                        <tr>
                            <th width="15%">@lang('backend.first_name')</th>
                            <th width="15%">@lang('backend.email')</th>
                            <th width="15%">@lang('backend.phone')</th>
                            <th width="15%">@lang('backend.role')</th>
                            <th width="10%">@lang('backend.active')</th>
                            <th width="30%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr {!! $user->deleted_at ? 'class="bg-red"' : '' !!}>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ implode(', ', $user->getRoleNames()->toArray()) }}</td>
                                <td>@if($user->active)
                                        <span class="label label-success">@lang('backend.yes')</span>
                                    @else
                                        <span class="label label-default">@lang('backend.no')</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    @include('backend.elements.edit_buttons', [
                                        'edit_link'    => route('backend.users.edit',['user'=> $user]),
                                        'destroy_link' => route('backend.users.destroy',['id' => $user->id]),
                                        'restore_link' => route('backend.users.restore',['id' => $user->id]),
                                        'model'        => $user,
                                    ])
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="bg-warning">
                                    <h3 class="text-center">
                                        @lang('backend.nothing_found')
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <?php echo $users->render(); ?>
                </div>
            </div>
        </div>
    </div>
@endsection

