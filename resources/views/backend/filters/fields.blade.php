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
        @if(isset($filter_values))
            <li class="nav-item">
                <a class="nav-link" id="value-tab" data-toggle="tab" href="#value" data-tab="#value"
                   role="tab"
                   aria-controls="profile" aria-selected="false">
                    @lang('backend.values') </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" data-tab="#seo"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.seo') </a>
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
                            {!! Form::text('alias', old('alias')??null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.type')</label>
                            {!! Form::select('filter_type_id', $filter_types, old('filter_type_id')??null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.categories')</label>
                            {!! Form::select('categories[]', $product_categories, old('categories')??(isset($filter) ? $filter->pages->pluck('id') : null), ['class'=>'form-control1 select2 js_categories', 'value' => old('page_product_id'), 'multiple' => "multiple"]) !!}
                        </div>

                        <div class="form-group">
                            <label>@lang('backend.position')</label>
                            {!! Form::number('position', old('position')??null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('active', 1, old('active')??null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('is_option', 1, old('is_option')??null, ['class' => 'js-switch']) !!}
                            @lang('backend.cart_option')
                            <small class="form-text text-muted">@lang('backend.filter_used_cart')</small>
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('is_technical', 1, old('is_technical')??null, ['class' => 'js-switch']) !!}
                            @lang('backend.technical_filter')
                            <small class="form-text text-muted">@lang('backend.technical_filters_category')</small>
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('is_calculator_volume', 1, old('is_calculator_volume')?? null, ['class' => 'js-switch is_calculator']) !!}
                            @lang('backend.is_calculator_volume')
                        </div>
                        <div class="checkbox">
                            {!! Form::checkbox('is_calculator_pressure', 1, old('is_calculator_pressure')?? null, ['class' => 'js-switch is_calculator']) !!}
                            @lang('backend.is_calculator_pressure')
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
                                    old($lang.'.name')??(isset($filter) ? $filter->{'name:'.$lang} : null),
                                    ['class'=>'form-control', 'placeholder'=>__('backend.name').' '.$lang]
                                ) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.description')</label>
                                {!! Form::textarea(
                                    $lang . '[description]',
                                    old($lang.'.description')??(isset($filter) ? $filter->{'description:'.$lang} : null),
                                    ['class'=>'form-control', 'placeholder'=>__('backend.description')]
                                ) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @if(isset($filter_values))
            <div class="tab-pane fade" id="value" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class="row">
                    <div class="col-6 col-md-8 col-lg-10"></div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <p>
                            <a href="{{ route('backend.filters.values.create', ['filter' => $filter]) }}"
                               class="btn btn-block btn-sm btn-success text-uppercase">
                                <i class="fa fa-plus"></i>
                                @lang('backend.value_new_create')
                            </a>
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>@lang('backend.name')</th>
                            <th>@lang('backend.position')</th>
                            <th>@lang('backend.alias')</th>
                            <th>@lang('backend.active')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($filter_values as $value)
                            <tr>
                                <td>{{$value->name}}</td>
                                <td>{{$value->position}}</td>
                                <td>{{$value->alias}}</td>
                                <td>
                                    @if($value->active)
                                        <span class="label label-success">@lang('backend.yes')</span>
                                    @else
                                        <span class="label label-danger">@lang('backend.no')</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('backend.filters.values.edit', ['filter'=> $filter, 'values' => $value]) }}"
                                       class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a data-method="delete"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="@lang('backend.delete_question')"
                                       href="{{ route('backend.filters.values.destroy', ['filter'=> $filter, 'values' => $value]) }}"
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
                    {{ $filter_values->links('backend.elements.pagination') }}
                </div>
            </div>
        @endif
        @include('backend.filters.includes.seo')
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.filters.index')])