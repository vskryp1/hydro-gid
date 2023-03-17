<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link"
               id="base-tab"
               data-toggle="tab"
               href="#base"
               data-tab="#base"
               role="tab"
               aria-controls="home"
               aria-selected="true">
                @lang('backend.base')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="locale-tab"
               data-toggle="tab"
               href="#locale"
               data-tab="#locale"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                @lang('backend.locale')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               id="delivery_places-tab"
               data-toggle="tab"
               href="#delivery_places"
               data-tab="#delivery_places"
               role="tab"
               aria-controls="profile"
               aria-selected="false">
                @lang('backend.delivery_places')
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="root-tab tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="type">@lang('backend.type') <span class="required">*</span></label>
                        {!! Form::select('type', DeliveryType::toSelectArray(), null, [
                            'class'       => 'form-control select2',
                            'required'    => true,
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="api_key">@lang('backend.api_key')</label><br>
                        {!! Form::text('api_key', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.default_price')</label>
                        {!! Form::number('original_price', old('original_price')??(isset($delivery)?ShopHelper::price_format($delivery->original_price, true):0), ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.currency')</label>
                        {!! Form::select('currency_id', $currencies_list??['-'], null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label>@lang('backend.position')</label>
                        {!! Form::number('position', old('position'), ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        <label for="active">@lang('backend.active')</label><br>
                        {!! Form::hidden('is_active', 0) !!}
                        {!! Form::checkbox('is_active', 1, null, ['id' => 'active', 'class' => 'js-switch']) !!}
                    </div>
                    <div class="form-group">
                        <label for="default">@lang('backend.default')</label><br>
                        {!! Form::hidden('is_default', 0) !!}
                        {!! Form::checkbox('is_default', 1, null, ['id' => 'default', 'class' => 'js-switch']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="root-tab tab-pane fade" id="locale" role="tabpanel" aria-labelledby="home-tab">
            <div class="row tabs-vertical-env tabs-vertical-bordered">
                <ul class="nav tabs-vertical" id="locales-tab" role="tablist" aria-orientation="vertical">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <li class="@if($loop->first) active @endif">
                            <a class="nav-link" id="locale-{{ $lang }}-tab" data-toggle="pill"
                               href="#locales-{{ $lang }}" role="tab" aria-controls="locales-{{ $lang }}"
                               aria-selected="true">
                                {{ strtoupper($lang) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="locales-tabContent">
                    @foreach(Setting::get('locales') as $lang => $locale)
                        <div class="tab-pane fade @if($loop->first) in active @endif" id="locales-{{ $lang }}"
                             role="tabpanel" aria-labelledby="locales-{{ $lang }}-tab">
                            <div class="form-group">
                                <label>@lang('backend.name') <span class="required">*</span></label>
                                {!! Form::text($lang . '[name]', $delivery->{'name:' . $lang} ?? null, [
                                    'class'       => 'form-control',
                                    'placeholder' => __('backend.name') . ' ' . $lang,
                                    'required'    => true,
                                ]) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('backend.description')</label>
                                {!! Form::text($lang . '[description]', $delivery->{'description:' . $lang} ?? null, [
                                    'class'       => 'form-control',
                                    'placeholder' => __('backend.description') . ' ' . $lang,
                                    'required'    => false,
                                ]) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="delivery_places" role="tabpanel" aria-labelledby="delivery_places-tab">
            @if(isset($delivery_places))
                <br>
                <div class="row">
                    <div class="col-6 col-md-8 col-lg-10">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <p>
                            <a href="{{ route('backend.deliveries.delivery_places.create', ['delivery' => $delivery]) }}"
                               class="btn btn-block btn-sm btn-success text-uppercase">
                                <i class="fa fa-plus"></i>
                                @lang('backend.delivery_place_create')
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
                            <th>@lang('backend.active')</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($delivery_places as $delivery_place)
                            <tr>
                                <td>{{$delivery_place->name}}</td>
                                <td>{{$delivery_place->position}}</td>
                                <td>
                                    @if($delivery_place->is_active)
                                        <span class="label label-success">@lang('backend.yes')</span>
                                    @else
                                        <span class="label label-danger">@lang('backend.no')</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('backend.deliveries.delivery_places.edit', ['delivery'=> $delivery, 'delivery_place' => $delivery_place]) }}"
                                       class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                    <a data-method="delete"
                                       data-token="{{csrf_token()}}"
                                       data-confirm="@lang('backend.delete_question')"
                                       href="{{ route('backend.deliveries.delivery_places.destroy', ['delivery'=> $delivery, 'delivery_place' => $delivery_place]) }}"
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
                    {{ $delivery_places->fragment('delivery_places')->links('backend.elements.pagination') }}
                </div>
            @else
                <h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.you_need_create_delivery')</h4>
            @endif
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.deliveries.index')])