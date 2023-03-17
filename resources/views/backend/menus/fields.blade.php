<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="menu_items-tab" data-toggle="tab" href="#menu_items" data-tab="#menu_items"
               role="tab"
               aria-controls="profile" aria-selected="false">
                @lang('backend.menu_items') </a>
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
                            {!! Form::text('alias', null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.type')</label>
                            {!! Form::select('type', $types, null, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <label>@lang('backend.page_parent')</label>
                            {!! Form::select('page_id', $pages, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="menu_items" role="tabpanel" aria-labelledby="menu_items-tab">
            @if(isset($menuItems))
                <div class="row">
                    <div class="col-6 col-md-8 col-lg-10"></div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <p>
                            <a href="{{ route('backend.menus.menu_items.create', ['menu' => $menu]) }}"
                               class="btn btn-block btn-sm btn-success text-uppercase">
                                <i class="fa fa-plus"></i>
                                @lang('backend.menu_items_create')
                            </a>
                        </p>
                    </div>
                </div>
                <div class="table-responsive">
                    <div id="tree_container">
                        <div id="js_tree"></div>
                    </div>
                </div>
{{--                                <br>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-6 col-md-8 col-lg-10"></div>--}}
{{--                                    <div class="col-6 col-md-4 col-lg-2">--}}
{{--                                        <p>--}}
{{--                                            <a href="{{ route('backend.menus.menu_items.create', ['menu' => $menu]) }}"--}}
{{--                                               class="btn btn-block btn-sm btn-success text-uppercase">--}}
{{--                                                <i class="fa fa-plus"></i>--}}
{{--                                                @lang('backend.menu_items_create')--}}
{{--                                            </a>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table table-striped">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th>@lang('backend.name')</th>--}}
{{--                                            <th>@lang('backend.parent')</th>--}}
{{--                                            <th>@lang('backend.type')</th>--}}
{{--                                            <th>@lang('backend.object')</th>--}}
{{--                                            <th>@lang('backend.link')</th>--}}
{{--                                            <th width="100px"></th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @forelse($menuItems as $menu_item)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$menu_item->menuable->name??$menu_item->name}}</td>--}}
{{--                                                <td>{{$menu_item->parent->menuable->name??$menu_item->parent->name??'-'}}</td>--}}
{{--                                                <td>{{ __('backend.menu_type_'.$menu_item->type) }}</td>--}}
{{--                                                <td>{{$menu_item->menuable->name??'-'}}</td>--}}
{{--                                                <td>{{$menu_item->link}}</td>--}}
{{--                                                <td class="text-right">--}}
{{--                                                    <a href="{{ route('backend.menus.menu_items.edit', ['menu'=> $menu, 'menu_item' => $menu_item]) }}"--}}
{{--                                                       class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>--}}
{{--                                                    <a data-method="delete"--}}
{{--                                                       data-token="{{csrf_token()}}"--}}
{{--                                                       data-confirm="@lang('backend.delete_question')"--}}
{{--                                                       href="{{ route('backend.menus.menu_items.destroy', ['menu'=> $menu, 'menu_item' => $menu_item]) }}"--}}
{{--                                                       class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @empty--}}
{{--                                            <tr>--}}
{{--                                                <td colspan="7">--}}
{{--                                                    <h3 class="text-center">--}}
{{--                                                        @lang('backend.nothing_found')--}}
{{--                                                    </h3>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforelse--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                    {{ $menuItems->links('backend.elements.pagination') }}--}}
{{--                                </div>--}}
            @else
                <h4 class="text-center"><i class="fa fa-info-circle"></i> @lang('backend.you_need_create_menu')</h4>
            @endif
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.menus.index')])