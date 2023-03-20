<ul class="root-tab nav nav-tabs" id="myTab" role="tablist">
    <li class="active">
        <a id="base-tab" data-toggle="tab" href="#base" role="tab" aria-expanded="true">
            @lang('backend.base')
        </a>
    </li>
    @if(Route::is('backend.pages.edit'))
        <li class="nav-item">
            <a class="" id="additional-fields-tab" data-toggle="tab" href="#additional-fields" role="tab" aria-expanded="false">
                @lang('backend.add_fields')
            </a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" role="tab" aria-expanded="false">
            @lang('backend.locale')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-expanded="false">
            @lang('backend.seo')
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="parent-tab" data-toggle="tab" href="#parent" data-tab="#parent" role="tab"
           aria-controls="profile" aria-selected="false">
            @lang('backend.parent')
        </a>
    </li>
</ul>