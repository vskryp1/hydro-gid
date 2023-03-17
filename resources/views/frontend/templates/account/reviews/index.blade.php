<div class="reviews personal__tab-content">
    <div class="personal__tab-title">
        {{ __('frontend/profile/index.my_reviews') }}
    </div>
    @isset($data['reviews'])
        @if($data['reviews']->count())
            <div class="personal__reviews">
                @foreach($data['reviews'] as $review)
                    @include('frontend.templates.account.reviews.item')
                @endforeach
            </div>
        @else
            {{ __('frontend.nothing_found') }}
        @endif
    @endisset
</div>