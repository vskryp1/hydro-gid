<div class="personal__reviews-box">
    <div class="personal__reviews-item">
        <div class="personal__reviews-element">
            <div class="personal__reviews-img">
                @if(ProductHelper::checkReviewTypeIsProduct($review->reviewable_type))
                <img src="{{ $review->reviewable->cover->getUrl('prod_xl') }}"
                         alt="{{ $review->reviewable->cover->getImageAlt() }}"
                         title="{{ $review->reviewable->cover->getImageTitle() }}"/>
                    @else
                    {!! Html::image('/assets/frontend/images/logo.svg', $page->name, ['title' => $page->name ]) !!}
                @endif
            </div>
            <div class="personal__reviews-info">
                <div class="personal__reviews-title">
                    @if(ProductHelper::checkReviewTypeIsProduct($review->reviewable_type))
                        <a href="{{ ProductHelper::getProductFromReviews($review->reviewable->sku) }}">
                            {{ $review->reviewable->format_name }}
                        </a>
                    @else
                        {{ __('frontend/review/index.about_website') }}
                        @endif
                </div>
                <div class="personal__component-title">
                    {{ $review->username }}
                    @if($review->answer)
                    <div class="icon icon-comment"></div>
                        @endif
                </div>
                <div class="personal__component-date">
                    {{ $review->created_at->format('Y-m-d') }}
                </div>
                <div class="star-box">
                    <div data-mark="{{ $review->rating }}"
                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                         class="star js_review star-fill hidden-mob"></div>
                </div>
                <div class="personal__reviews-text">
                    {{ $review->comment }}
                </div>
            </div>
            @if($review->answer)

                <div class="personal__reviews-btn">
                    <span class="icon icon-arrow-down"></span>
                </div>
            @endif
        </div>
    </div>
    @if($review->answer)
        <div class="personal__reviews-component">
            <div class="personal__component-inner">
                <div class="personal__component-title">
                    {{ __('frontend/review/index.admin_answer') }}
                </div>
                <div class="personal__component-date">
                    {{ $review->updated_at->format(config('app.formats.php.date')) }}
                    {{ __('frontend/review/index.in') }}
                    {{ $review->updated_at->format(config('app.formats.php.time')) }}
                </div>
                <div class="personal__component-text">
                    {{ $review->answer }}
                </div>
            </div>
        </div>
    @endif
</div>