<section class="prod-feature-all">
    <div class="container">
        <div class="tab-general-box tab-area">
            <ul class="tab-navigation flex-wrap tab-fill" id="scroll-review">
                @if($product->description)
                <li class="active">
                    <a href="#descr-tab">
                        <span class="tab-item">@lang('frontend/product/index.description')</span>
                    </a>
                </li>
                @endif
                @if($baseFilters->isNotEmpty() || $technicalFilters->isNotEmpty())
                    <li>
                        <a href="#specific-tab">
                            <span class="tab-item">@lang('frontend/product/index.specifications')</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="#reviews-tab">
                        <span class="tab-item">@lang('frontend/product/index.reviews')</span>
                    </a>
                </li>
            </ul>
            <div class="tab-container">
                @if($product->description)
                <div id="feature-all-1" class="tab-box active">
                    {!! $product->description !!}
                </div>
                @endif
                @if($baseFilters->isNotEmpty() || $technicalFilters->isNotEmpty())
                    <div id="feature-all-2" class="tab-box">
                        @if($baseFilters->isNotEmpty())
                            <div class="h3">@lang('frontend/product/index.main_params')</div>
                            <ul class="characteristics-table">
                                @foreach($baseFilters as $filter)
                                    <li>
                                        <strong class="dd">{{ $filter->name }}</strong>
                                        <span class="dt">{{ $filter->filter_values->pluck('name')->implode(', ') }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if($technicalFilters->isNotEmpty())
                            <div class="h3">@lang('frontend/product/index.technical_params')</div>
                            <ul class="characteristics-table">
                                @foreach($technicalFilters as $filter)
                                    <li>
                                        <strong class="dd">{{ $filter->name }}</strong>
                                        <span class="dt">{{ $filter->filter_values->pluck('name')->implode(', ')  }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif
                <div id="feature-all-3" class="tab-box">
                    <div class="row reverse-md">
                        <div class="col-lg-6 col-md-7">
                            <div class="review-section">
                                @forelse($reviews as $review)
                                    <div class="review-one">
                                        <div class="review-one__qw">
                                            <div class="review-one__img">
                                                <img src="{{ url('/assets/frontend/images/user.jpg') }}" alt="user"/>
                                            </div>
                                            <div class="review-one__top">
                                                <div class="review-one__name">
                                                    {{ $review->username }}
                                                </div>
                                                <div class="review-one__date">
                                                    {{ $review->created_at->format('d.m.Y') }}
                                                    {{ __('frontend/review/index.in') }}
                                                    {{ $review->created_at->format('H:i') }}
                                                </div>
                                                <div class="star-box">
                                                    <div class="star js_review star-fill hidden-mob"
                                                         data-mark="{{ $review->rating }}"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="review-one-content content">
                                                {{ $review->comment }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty">{{ __('frontend.no_reviews_yet') }}</div>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5">
                            <div class="write-review-box">
                                <div class="h2">
                                    {{ __('frontend/review/index.leave_your_review') }}
                                </div>
                                @include('frontend.elements.forms.product-review', [
                                    'reviewable_id'   => $product->id,
                                    'reviewable_type' => Review::PRODUCT,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
