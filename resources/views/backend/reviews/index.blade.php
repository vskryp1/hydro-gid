@extends('backend.layouts.backend')

@section('title', __('backend.reviews'))

@section('search')
    @include('backend.elements.search', ['url' => route('backend.reviews.index')])
@endsection

@section('content')
    @include('backend.elements.create_button', [
        'create_link'  => route('backend.reviews.create'),
        'name'         => __('backend.reviews_create'),
    ])
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>{{ __('backend/review/index.username') }}</th>
                <th>{{ __('backend/review/index.email') }}</th>
                <th>{{ __('backend/review/index.type') }}</th>
                <th>{{ __('backend/review/index.object') }}</th>
                <th>{{ __('backend/review/index.rating') }}</th>
                <th>{{ __('backend/review/index.comment') }}</th>
                <th>{{ __('backend/review/index.answer') }}</th>
                <th>{{ __('backend/review/index.is_active') }}</th>
                <th>{{ __('backend/review/index.date') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->username }}</td>
                    <td>{{ $review->email }}</td>
                    <td>{{ Review::getTranslationType($review->reviewable_type) }}</td>
                    <td><a href="{{ LaravelLocalization::localizeUrl($review->reviewable->alias) }}" target="_blank">{{ $review->reviewable->format_name }}</a></td>
                    <td>{{ Review::drawStars($review->rating) }}</td>
                    <td>{{ Str::limit($review->comment, 50) }}</td>
                    <td>{{ $review->answer ? Str::limit($review->answer, 50) : __('backend/review/index.missing') }}</td>
                    <td>
                        @if($review->is_active)
                            <span class="label label-success">{{ __('backend.yes') }}</span>
                        @else
                            <span class="label label-danger">{{ __('backend.no') }}</span>
                        @endif
                    </td>
                    <td>{{ Carbon::parse($review->created_at)->format(config('app.formats.php.date'))}}</td>
                    <td>
                        @include('backend.elements.edit_buttons', [
                             'edit_link'    => route('backend.reviews.edit', ['review' => $review]),
                             'destroy_link' => route('backend.reviews.destroy', ['review' => $review]),
                         ])
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">
                        <h3 class="text-center">
                            <i class="fa fa-info"></i>
                            {{ __('backend.nothing_found') }}
                        </h3>
                    </td>
                </tr>
            @endforelse
            </tbody>
            @isset($reviews)
                <tfoot>
                <tr>
                    <td colspan="10">
                        <div class="text-center">
                            {!! $reviews->render('backend.elements.pagination') !!}
                        </div>
                    </td>
                </tr>
                </tfoot>
            @endisset
        </table>
    </div>
@endsection