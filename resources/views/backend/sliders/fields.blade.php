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
        <li class="nav-item">
            <a class="nav-link" id="slider_items-tab" data-toggle="tab" href="#slider_items" data-tab="#slider_items"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.slider_items') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label>@lang('backend.alias')</label>
                            <small class="form-text text-muted">@lang('backend.must_unique')</small>
                            {!! Form::text('alias', null, ['class'=>'form-control', 'disabled' => isset($slider)]) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
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
                                <label>@lang('backend.name') <span class="required">*</span></label>
                                {!! Form::text(
                                    $lang . '[name]',
                                    old($lang.'.name')??(isset($slider) ? $slider->{'name:'.$lang} : null),
                                    ['class'=>'form-control', 'placeholder'=>__('backend.name'), 'data-validation'=>'required', 'required']
                                ) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
            <div class="tab-pane fade" id="slider_items" role="tabpanel" aria-labelledby="slider_items-tab">
                @if(isset($slider_items))
                <br>
                <div class="row">
                    <div class="col-6 col-md-8 col-lg-10"></div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <p>
                            <a href="{{ route('backend.sliders.slider_items.create', ['slider' => $slider]) }}"
                               class="btn btn-block btn-sm btn-success text-uppercase">
                                <i class="fa fa-plus"></i>
                                @lang('backend.item_new_create')
                            </a>
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('backend.image')</th>
                            <th>@lang('backend.title')</th>
                            <th>@lang('backend.link')</th>
                            <th>@lang('backend.position')</th>
                            <th>@lang('backend.active')</th>
                            <th width="100px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($slider_items as $slider_item)
                            <tr>
                                <td><img src="{{$slider_item->getUrl() }}" width="80px"></td>
                                <td>{{$slider_item->title}}</td>
                                <td>{{$slider_item->link}}</td>
                                <td>{{$slider_item->position}}</td>
                                <td>
                                    @if($slider_item->active)
                                        <span class="label label-success">@lang('backend.yes')</span>
                                    @else
                                        <span class="label label-danger">@lang('backend.no')</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('backend.sliders.slider_items.edit', ['slider'=> $slider, 'slider_item' => $slider_item]) }}"
                                       class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a data-method="delete"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="@lang('backend.delete_question')"
                                       href="{{ route('backend.sliders.slider_items.destroy', ['slider'=> $slider, 'slider_item' => $slider_item]) }}"
                                       class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h3 class="text-center">
                                        @lang('backend.nothing_found')
                                    </h3>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $slider_items->links('backend.elements.pagination') }}
                </div>
                @else
                    <h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.you_need_create_slider')</h4>
                @endif
            </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.sliders.index')])