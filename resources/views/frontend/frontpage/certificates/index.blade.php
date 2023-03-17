@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/certificates.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="certificates">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="page__title page--line">
                <div class="container">
                    Сертификаты
                </div>
            </div>
            <div class="container">
                <div class="certificates__inner">
                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>

                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>
                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>
                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>
                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>
                    <a href="{{asset('assets/frontend/images/content/certificates.jpg') }}" data-fancybox="images">
                        <img src="{{asset('assets/frontend/images/content/certificates.jpg') }}"/>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
