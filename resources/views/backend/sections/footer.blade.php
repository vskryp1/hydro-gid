<div class="clearfix"></div>
<div class="row">
    <div class="pull-right">
        {{ collect([
            'Ⓒ',
            date('Y'),
            config('app.name'),
            __('backend.all_rights_reserved')
        ])->implode(' ') }}
    </div>
</div>
<div class="row">
    <div class="pull-right">
        {{ __('backend.development_support') }}:
        <a href="https://artjoker.ua/" target="_blank" rel="noreferrer">
            {!! Html::image('/assets/frontend/images/footer-artjoker.svg', 'ooter-artjoker') !!}
        </a>
    </div>
</div>
<div class="clearfix"></div>