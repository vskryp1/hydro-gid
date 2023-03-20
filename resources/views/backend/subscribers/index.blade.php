@extends('backend.layouts.backend')

@section('title')
    @lang('backend.subscribers')
@endsection

@section('content')
<div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>@lang('backend.email')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($subscribers as $subscriber)
                <tr>
                    <td>{{ $subscriber->email }}</td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                            'destroy_link' => route('backend.subscribers.destroy',['subscriber' => $subscriber]),
                            'permission' => 'subscribers',
                        ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="bg-warning">
                        <h3 class="text-center">
                            @lang('backend.no_items')
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
