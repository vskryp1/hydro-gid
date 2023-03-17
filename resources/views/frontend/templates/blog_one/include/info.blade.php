<div class="article__info">
    <div class="article__date">{{ $page->updated_at->translatedFormat('j F Y') }}</div>
    <div class="article__social">
        @lang('frontend/content/index.share_social'):
        <a target="_blank" href="{{ Share::load(url()->current())->facebook() }}">
            <i class="icon icon-fb"></i>
        </a>
        <a target="_blank" href="{{ Share::load(url()->current())->linkedin() }}">
            <i class="icon icon-linkedin"></i>
        </a>
    </div>
</div>