<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border:0;">
            <a href="{{ route('backend.dashboard') }}" class="site_title">
                <img height="50"
                     src="{{ asset('/assets/backend/images/logo.svg') }}"
                     alt="{{ config('app.name') }}">
                <span>{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ auth()->user()->avatar }}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>@lang('backend.welcome'),</span>
                <h2>{{ auth()->user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section active">
                <ul class="nav side-menu" style="">
                    <li class="">
                        <a href="{{ route('backend.dashboard') }}">
                            <i class="fa fa-line-chart"></i>
                            @lang('backend.dashboard')
                        </a>
                    </li>
                    <li><a><i class="fa fa-users"></i> @lang('backend.users') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list admins')<li><a href="{{ route('backend.users.index') }}">@lang('backend.user_managment')</a></li>@endcan
                            @can('list clients')<li><a href="{{ route('backend.clients.index') }}">@lang('backend.clients')</a></li>@endcan
                            @can('list roles')<li><a href="{{ route('backend.roles.index') }}">@lang('backend.roles')</a></li>@endcan
                            @can('list permissions')<li><a href="{{ route('backend.permissions.index') }}">@lang('backend.permissions')</a></li>@endcan
                            @can('list reviews')<li><a href="{{ route('backend.reviews.index') }}">@lang('backend.reviews')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cubes"></i> @lang('backend.products') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list products')<li><a href="{{ route('backend.products.index') }}">@lang('backend.products')</a></li>@endcan
                            @can('list filters')<li><a href="{{ route('backend.filters.index') }}">@lang('backend.filters')</a></li>@endcan
                            @can('list product statuses')<li><a href="{{ route('backend.products.statuses.index') }}">@lang('backend.statuses')</a></li>@endcan
                            @can('list stocks')<li><a href="{{ route('backend.stocks.index') }}">@lang('backend/stocks/index.stocks')</a></li>@endcan
                            @can('list products')<li><a href="{{ route('backend.warranties.index') }}">@lang('backend/product/index.warranty')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-folder-open"></i> @lang('backend.pages') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list pages')<li><a href="{{ route('backend.pages.index') }}">@lang('backend.pages')</a></li>@endcan
                            @can('list page templates')<li><a href="{{ route('backend.templates.index') }}">@lang('backend.templates')</a></li>@endcan
                            @can('list sliders')<li><a href="{{ route('backend.sliders.index') }}">@lang('backend.sliders')</a></li>@endcan
                            @can('list menus')<li><a href="{{ route('backend.menus.index') }}">@lang('backend.menus')</a></li>@endcan
                            @can('list faq')<li><a href="{{ route('backend.faqs.index') }}">@lang('backend/faq/index.faq')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-shopping-cart"></i> @lang('backend.orders') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list orders buy click')<li><a href="{{ route('backend.orders.order_buy_click') }}">@lang('backend.orders_buy_click')</a></li>@endcan
                            @can('list orders')<li><a href="{{ route('backend.orders.index') }}">@lang('backend.orders')</a></li>@endcan
                            @can('list order statuses')<li><a href="{{ route('backend.orders.statuses.index') }}">@lang('backend.order_status')</a></li>@endcan
                            @can('list payments')<li><a href="{{ route('backend.payments.index') }}">@lang('backend.payments')</a></li>@endcan
                            @can('list deliveries')<li><a href="{{ route('backend.deliveries.index') }}">@lang('backend.deliveries')</a></li>@endcan
                            @can('list service order')<li><a href="{{ route('backend.service-orders.index') }}">@lang('backend/service/index.service_order')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-line-chart"></i> @lang('backend.seo') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list seo redirects')<li><a href="{{ route('backend.seo-redirects.index') }}">@lang('backend.redirects')</a></li>@endcan
                            @can('list seo robots')<li><a href="{{ route('backend.seo-robots.index') }}">@lang('backend.robots')</a></li>@endcan
                            @can('list seo scripts')<li><a href="{{ route('backend.seo-scripts.index') }}">@lang('backend.scripts')</a></li>@endcan
                            @can('list seo meta')<li><a href="{{ route('backend.seo-metas.index') }}">@lang('backend.seo_meta')</a></li>@endcan
                            @can('list seo sitemap')<li><a href="{{ route('backend.sitemap.index') }}">@lang('backend.seo-sitemap')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-envelope"></i> @lang('backend.mails') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list mail')<li><a href="{{ route('backend.mail.templates.index') }}">@lang('backend.templates')</a></li>@endcan
                            @can('list main template')<li><a href="{{ route('backend.edit.main.template') }}">@lang('backend.main_template')</a></li>@endcan
                            @can('list mail')<li><a href="{{ route('backend.subscribers.settings') }}">@lang('backend.mail_settings')</a></li>@endcan
                            @can('list subscribers')<li><a href="{{ route('backend.subscribers.index') }}">@lang('backend.subscribers')</a></li>@endcan
                            @can('list newsletter')<li><a href="{{ route('backend.mail.email.templates.index') }}">@lang('backend.newsletter')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> @lang('backend.import_export') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list import export clients')<li><a href="{{ route('backend.import-export.clients.index') }}">@lang('backend.clients')</a></li>@endcan
                            @can('list import export products')<li><a href="{{ route('backend.import-export.products.index') }}">@lang('backend.products')</a></li>@endcan
                            @can('list import export orders')<li><a href="{{ route('backend.import-export.orders.index') }}">@lang('backend.orders')</a></li>@endcan
                        </ul>
                    </li>
                    <li><a><i class="fa fa-gear"></i> @lang('backend.settings') <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" display="none">
                            @can('list translations')<li><a href="{{ route('backend.settings.translations.index') }}">@lang('backend.translations')</a></li>@endcan
                            @can('list currencies')<li><a href="{{ route('backend.settings.currencies.index') }}">@lang('backend.currencies')</a></li>@endcan
                            @can('services')<li><a href="{{ route('backend.settings.backups.index') }}">@lang('backend.backup')</a></li>@endcan
                            @can('list settings')<li><a href="{{ route('backend.settings.global.index') }}">@lang('backend.settings')</a></li>@endcan
                            <li><a href="{{route('backend.clearCache')}}" data-do="link"
                               data-dialog="@lang('backend.cache_clear_confirmation')" data-toggle="tooltip" data-placement="top">
                                    @lang('backend.clear_cache')
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title=""  onclick="return false;">
                <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
            </a>
            <a href="{{route('backend.clearCache')}}" data-do="link"
               data-dialog="@lang('backend.cache_clear_confirmation')" data-toggle="tooltip" data-placement="top"
               title="" data-original-title="@lang('backend.clear_cache')">
                <span class="glyphicon glyphicon-erase" aria-hidden="true"></span>
            </a>
            <a href="{{url('/')}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('backend.go_to_site')">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" target="_blank" data-placement="top" title="@lang('backend.logout')" href="{{ route('backend.logout') }}"
               data-original-title="@lang('backend.logout')">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
