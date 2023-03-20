@forelse($faqs as $faq)
    <div class="questions__item">
        {{ $faq->question }}
        <span class="icon icon-arrow-down"></span>
    </div>
    <div class="questions__item-answer">
        {!! $faq->answer !!}
    </div>
@empty
    @lang('frontend.nothing_found')
@endforelse
