@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/compare.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/compare.js')) !!}
@endsection

@section('content')
    <main class="main compare-page">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg.jpg') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
                <div class="page__title">Сравнение товаров</div>
            </div>
        </div>
        <section class="category__box container">
            <div class="category__box--parent">
                <div class="h3">Категория 1</div>
                <div class="category__box--item row">
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="main-btn main-btn--green" href="#">Сравнить товары <i class="icon icon-balance"></i></a>

            </div>
            <div class="category__box--parent">
                <div class="h3">Категория 2</div>
                <div class="category__box--item row">
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                 alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8"
                                    (Италия)
                                </div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                    <div class="checkout__aside-sum">
                                        100 шт
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="main-btn main-btn--green" href="#">Сравнить товары <i class="icon icon-balance"></i></a>
            </div>
        </section>
    </main>
@endsection