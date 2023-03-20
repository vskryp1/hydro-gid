@extends('backend.layouts.backend')

@section('title')
    @lang('backend.permissions')
@endsection

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row col-md-12">
            @include('backend.elements.create_button', [
                'create_link'  => route('backend.permissions.create'),
                'name'         => __('backend.create_new_permission')
            ])
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('backend.name')</th>
                            <th width="50%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $currPermission)
                            <tr>
                                <td>{{ $currPermission->name }}</td>
                                <td class="text-right">
                                    @include('backend.elements.edit_buttons', [
                                            'edit_link'    => route('backend.permissions.edit',['permission'=> $currPermission]),
                                            'destroy_link' => route('backend.permissions.destroy',['id' => $currPermission->id])
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