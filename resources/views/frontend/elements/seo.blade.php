@hasSection('seo_content')
    <div class="seo content-page">
            <div class="container">
                <div class="seo__title">
                    {{--@yield('h1')--}}
                </div>
                <div class="sep__text-wrapper content">
                    <div class="seo__text">
                        @yield('seo_content')
                    </div>
                </div>
            </div>
    </div>
@endif