@extends('frontend.layout')

@section('title', $seo_meta['seo_title'])
@section('description', $seo_meta['seo_description'])
@section('keywords', $seo_meta['seo_keywords'])
@section('robots', $seo_meta['seo_robots'])
@section('canonical', $seo_meta['seo_canonical'])
@include('frontend.elements.ogMeta')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/reviews.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! JsValidator::formRequest('App\Http\Requests\Frontend\Review\SaveFormRequest', '#page-review-form') !!}
    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="reviews">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="reviews__title page--line">
                <div class="container">
                    {{ $page->name }}
                </div>
            </div>
            <div class="container">
                <div class="reviews__inner">
                    <div class="reviews__content">
                        @forelse($data['reviews'] as $review)
                            <div class="reviews__item @if($review->answer) answer @endif">
{{--                                <div class="reviews__item-img">--}}
{{--                                    <img src="{{ url('/assets/frontend/images/user.jpg') }}" alt="user">--}}
{{--                                </div>--}}
                                <div class="reviews__item-box">
                                    <div class="reviews__item-name">
                                        {{ $review->username }}
                                    </div>
                                    <div class="reviews__item-date">
                                        {{ $review->created_at->format('d.m.Y') }}
                                        {{ __('frontend/review/index.in') }}
                                        {{ $review->created_at->format('H:i') }}
                                    </div>
                                    <div class="star-box">
                                        <div class="star js_review star-fill hidden-mob" data-mark="{{ $review->rating }}"
                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}">
                                        </div>
                                    </div>
                                    <div class="reviews__item-text">
                                        {{ $review->comment }}
                                    </div>
                                </div>
                            </div>
                            @if($review->answer)
                                <div class="reviews__item-answer">
                                    <div class="reviews__item-box">
                                        <div class="reviews__item-name">
                                            {{ __('frontend/review/index.admin_answer') }}
                                        </div>
                                        <div class="reviews__item-date">
                                            {{ $review->updated_at->format('d.m.Y') }}
                                            {{ __('frontend/review/index.in') }}
                                            {{ $review->updated_at->format('H:i') }}
                                        </div>
                                        <div class="reviews__item-text">
                                            {{ $review->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            {{ __('frontend.nothing_found') }}
                        @endforelse
                    </div>
                    <div class="reviews__form">
                        <div class="reviews__form-title">
                            {{ __('frontend/review/index.leave_your_review') }}
                        </div>
                        @include('frontend.elements.forms.page-review', [
                            'reviewable_id'   => $page->id,
                            'reviewable_type' => Review::PAGE,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection