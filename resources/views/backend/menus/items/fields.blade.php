<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="locale-tab" data-toggle="tab" href="#locale" data-tab="#locale"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.locale') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.position')</label>
                            {!! Form::number('position', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.type')</label>
                            {!! Form::select('type', $types, null, ['class'=>'form-control', 'id' => 'menuType']) !!}
                        </div>
                        {!! Form::hidden('menuable_type', null, ['class'=>'form-control', 'id' => 'modelName']) !!}
                        <div class="form-group">
                            <label>@lang('backend.object')</label>
                            {!! Form::select('menuable_id', isset($menu_item) && $menu_item->menuable ? [$menu_item->menuable->id => $menu_item->menuable->name] : [], null,['class'=>'form-control', 'id' => 'modelResults']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.parent')</label>
                            {!! Form::select('menu_item_id', $menu_items, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <br>
            <div class="row tabs-vertical-env tabs-vertical-bordered">

                <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class=" @if ($loop->first) active @endif"><a class="nav-link"
                                                                         id="v-pills-{{ $lang }}-tab"
                                                                         data-toggle="pill"
                                                                         href="#v-pills-{{ $lang }}"
                                                                         role="tab"
                                                                         aria-controls="v-pills-{{ $lang }}"
                                                                         aria-selected="true">{{ strtoupper($lang) }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab-content" id="v-pills-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if ($loop->first)in active @endif"
                             id="v-pills-{{ $lang }}" role="tabpanel"
                             aria-labelledby="v-pills-{{ $lang }}-tab">

                            <div class="form-group">
                                <label>@lang('backend.name')</label>
                                {!! Form::text(
                                    $lang . '[name]',
                                    old($lang.'.name')??(isset($menu_item) ? $menu_item->{'name:'.$lang} : null),
                                    ['class'=>'form-control','placeholder'=>__('backend.name'), 'data-validation'=>'required', 'required']
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.attributes')</label>
                                {!! Form::text(
                                    $lang . '[properties]',
                                    old($lang.'.properties')??(isset($menu_item) ? $menu_item->{'properties:'.$lang} : null),
                                    ['class'=>'form-control','placeholder'=>__('backend.attributes')]
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.link')</label>
                                {!! Form::text(
                                    $lang . '[link]',
                                    old($lang.'.link')??(isset($menu_item) ? $menu_item->{'link:'.$lang} : null),
                                    ['class'=>'form-control','placeholder'=>__('backend.link')]
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.image')</label>
                                @if(isset($menu_item) && $menu_item->{'image:'.$lang} != '')
                                    <br>
                                    <div class="text-center">
                                        <img src="/cache/menu_md/{{$menu_item->{'image:'.$lang} }}" width="250px">
                                    </div>
                                    <br>
                                @endif
                                {!! Form::file($lang . '[image]', ['class'=>'form-control','placeholder'=>__('backend.image')]) !!}

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
