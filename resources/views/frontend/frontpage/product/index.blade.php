@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/product.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/product.js')) !!}
@endsection

@section('content')
    <main class="main product-page">
        <div class="products" style="background-image: url('{{ url('/assets/frontend/images/serv-bg.jpg') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
        </div>
        <section class="product-info">
            <div class="container">
                <div class="product-info__top">
                    <div class="product-info__left">
                        <div class="products__title">Аксиально - поршневой насос BAP 37 - 110 см3</div>
                        <div class="prod-article">Артикул: <span>23414145</span> <i class="icon icon-copy"></i></div>
                    </div>
                    <div class="product-info__right">
                        <a href="#" class="main-btn">сформировать PDF</a>
{{--                        <div class="btn-info"><i class="icon icon-balance"></i></div>--}}
                        <div class="btn-info">?</div>
                    </div>
                </div>
                <div class="two-column-prod row">
                    <div class="item-prod-left">
                        <div class="row product-main-section-row">
                            <div class="product-main-section col-xs-6">
                                <div class="product-main-slider">
                                    <div class="product-one-slider__img">
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item slide-item-video">
                                            <div class="icon icon-youtube"></div>
                                                <a href="https://youtu.be/2C54yz6gS-E" data-fancybox>
                                                    <img src="{{asset('assets/frontend/images/img01.jpg') }}"
                                                         alt="#"/>
                                                </a>
                                            </div>
                                    </div>
                                    <div class="product-one-slider__thumb">
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item"><img
                                                    src="{{asset('assets/frontend/images/img-11.jpg') }}"
                                                    alt="#"/></div>
                                        <div class="slide-item slide-item-video">
                                            <div class="icon icon-youtube"></div>
                                            <a href="https://youtu.be/2C54yz6gS-E" data-fancybox>
                                                <img src="{{asset('assets/frontend/images/img01.jpg') }}"
                                                     alt="#"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="characterisrics-prod">
                                        <span class="ttl">основные Характеристики:</span>
                                        <ul>
                                            <li>Максимальное давление: 260 бар</li>
                                            <li>Максимальный рабочий объем: 91 см3/об</li>
                                            <li>Алюминиевый корпус</li>
                                            <li>Возможно секционное исполнение</li>
                                            <li>Максимальное давление: 260 бар</li>
                                            <li>Максимальный рабочий объем: 91 см3/об</li>
                                            <li>Алюминиевый корпус</li>
                                            <li>Возможно секционное исполнение</li>
                                        </ul>
                                        <a href="javascript:void(0);" class="btn-more-chk js-btn-more-chk">Все
                                            характеристики</a>
                                    </div>
                                </div>
                            </div>
                            <div class="choose-config-section col-xs-6">

                                <div class="border-holder row between-xs">
                                    <div class="column-left">
                                        <div class="prod-status in-stock">Есть в наличии</div>
                                        <div class="prod-status">Оптом и в розницу</div>
                                    </div>
                                    <div class="column-right">
                                        <div class="star-box">
                                            <div data-mark="4"
                                                 data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                 data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                 class="star js_review star-fill hidden-mob"></div>
                                            <a href="#scroll-review" class="review-qw js_scroll-review">18 отзывов</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-holder row middle-xs">
                                    <strong class="choose-config__title">Выбор по параметрам:</strong>
                                    <a href="#" class="config__memory">40 см3</a>
                                    <a href="#" class="config__memory">63 см3</a>
                                    <a href="#" class="config__memory">80 см3</a>
                                    <a href="#" class="config__memory active">110 см3</a>
                                </div>
                                <div class="border-holder row middle-xs">
                                    <form action="#">
                                        <div class="choose-settings">
                                            <input type="radio" id="radio1" name="radio-group" checked>
                                            <label for="radio1">Гарантия на 1 год <strong>1 000 грн</strong></label>
                                        </div>
                                        <div class="choose-settings">
                                            <input type="radio" id="radio2" name="radio-group">
                                            <label for="radio2">Гарантия на 2 года <strong>2 000 грн</strong></label>
                                        </div>
                                        <div class="choose-settings">
                                            <input type="radio" id="radio3" name="radio-group">
                                            <label for="radio3">Гарантия на 5 лет <strong>5 000 грн</strong></label>
                                        </div>
                                    </form>
                                </div>
                                <div class="row about-prod-row">
                                    <div class="about-prod">
                                        <div class="flex-row">
                                            <div class="cols">
                                                <div class="prise-old">800 550 грн</div>
                                                <div class="prise-new">800 550 <span class="val">грн</span></div>
                                            </div>
                                            <div class="quantity-cart js_quantity">
                                                <span class="js_minus btn-count btn-count--minus btn-count--disable">-</span>
                                                <input type="text" class="js-changeAmount count" value="1"
                                                       readonly="">
                                                <span class="js_plus btn-count btn-count--plus">+</span>
                                            </div>
                                        </div>
                                        <div class="flex-row">
                                            <div class="cols">
                                                <a href="#" data-fancybox data-src="#modal-basket"
                                                   class="main-btn main-btn--green">Купить</a>
                                            </div>
                                            <div class="cols">
                                                <a href="#" class="mark"><i class="icon icon-balance"></i></a>
                                                <a href="#" class="mark"><i class="icon icon-bookmarks"></i></a>
                                            </div>
                                        </div>
                                        <div class="flex-row">
                                            <a href="#" class="btn-download" target="_blank">
                                                <i class="icon icon-download"></i>
                                                <span>Скачать техническую документацию</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <aside class="item-prod-right">
                        @include('frontend.frontpage.product.filters')
                    </aside>
                </div>
            </div>
        </section>
        <div class="sentence" style="background-image: url(../images/serv-bg.jpg);">
            <div class="container">
                <div class="benefits__title">С этим товаром покупают</div>
                <div class="slider-prod js-slider-prod">
{{--                    <div class="item">-- просто проверяла работу слайдера, при необходимости - разкомментить обратно, удалить статичную верстку }}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem') просто проверяла работу слайдера, при необходимости - разкомментить обратно, удалить статичную верстку--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="prod-feature-all">
            <div class="container">
                <div class="tab-general-box tab-area">
                    <ul class="tab-navigation flex-wrap tab-fill">
                        <li><a href="#feature-all-1" class="active"><span class="tab-item">описание</span></a></li>
                        <li><a href="#feature-all-2"><span class="tab-item">Характеристики</span></a></li>
                        <li><a href="#feature-all-3"><span class="tab-item">отзывы</span></a></li>
                    </ul>
                    <div class="tab-container">
                        <div id="feature-all-1" class="tab-box">
                            <div class="h3">Гидрораспределитель WE6 НА</div>
                            <p>
                                Гидрораспределители WE6 НА являются гидроаппаратами плитного (стыкового) монтажа. Их
                                преимущества в удобном, простом монтаже, компактности гидроблока. Они являются полным
                                аналогом агрегатов серий: BE6, PE6. Производителем гидрораспределителей WE6 НА является
                                успешная итальянская компания «OLEODINAMICA MOZIONI», которая по соотношению
                                цена-качество
                                производимой гидравлической продукции является конкурентоспособной на европейском рынке
                                гидрооборудования. Гидрораспределители WE6 НА этой компании производятся по всем
                                европейским
                                стандартам и являются прямыми аналогами гидрораспределителей этого же типоразмера (ДУ6)
                                ведущих мировых производителей, таких как «Rexroth», «Parker», «Vickers», «Atos»,
                                «Ponar»
                                итд
                            </p>
                            <div class="h3">Модификации и присоединительные размеры WE6 НА</div>
                            <p>
                                Гидрораспределители WE6 НА в стандартном исполнении для более удобной диагностики его
                                работы
                                комплектуются разъемом со светодиодной индикацией. Стыковая поверхность
                                гидрораспределителя
                                унифицирована, обеспечивая взаимозаменяемость с гидроаппаратами других производителей.
                                Монтаж осуществляется с помощью четырех винтов М5х50 с внутренним шестигранником
                            </p>
                            <img src="{{asset('assets/frontend/images/img-15.jpg') }}"/>
                            <div class="h3">Модификации и присоединительные размеры WE6 НА</div>
                            <p>
                                Гидрораспределители WE6 НА в стандартном исполнении для более удобной диагностики его
                                работы
                                комплектуются разъемом со светодиодной индикацией. Стыковая поверхность
                                гидрораспределителя
                                унифицирована, обеспечивая взаимозаменяемость с гидроаппаратами других производителей.
                                Монтаж осуществляется с помощью четырех винтов М5х50 с внутренним шестигранником
                            </p>
                        </div>
                        <div id="feature-all-2" class="tab-box">
                            <div class="h3">Основные характеристики</div>
                            <ul class="characteristics-table">
                                <li>
                                    <strong class="dd">Производитель</strong>
                                    <span class="dt">Oleodinamica Mozioni</span>
                                </li>
                                <li>
                                    <strong class="dd">Страна - производительь</strong>
                                    <span class="dt">Италия</span>
                                </li>
                                <li>
                                    <strong class="dd">Состояние</strong>
                                    <span class="dt">Новое</span>
                                </li>
                                <li>
                                    <strong class="dd">Гарантийный срок</strong>
                                    <span class="dt">12 мес</span>
                                </li>
                            </ul>
                            <div class="h3">Технические характеристики</div>
                            <ul class="characteristics-table">
                                <li>
                                    <strong class="dd">ДУ</strong>
                                    <span class="dt">6</span>
                                </li>
                                <li>
                                    <strong class="dd">Схема</strong>
                                    <span class="dt">НА</span>
                                </li>
                                <li>
                                    <strong class="dd">Рабочее давление</strong>
                                    <span class="dt">315 Бар</span>
                                </li>
                                <li>
                                    <strong class="dd">Номинальный расход</strong>
                                    <span class="dt">40 л/мин</span>
                                </li>
                                <li>
                                    <strong class="dd">Максимальный расход</strong>
                                    <span class="dt">80 л/мин</span>
                                </li>
                                <li>
                                    <strong class="dd">Вес</strong>
                                    <span class="dt">2,2 кг</span>
                                </li>
                            </ul>
                        </div>
                        <div id="feature-all-3" class="tab-box">
                            <div class="row reverse-md">
                                <div class="col-lg-6 col-md-7">
                                    <div class="review-section">
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-one border-bottom">
                                            <div class="review-one__qw">
                                                <div class="review-one__img">
                                                    <img src="{{asset('assets/frontend/images/user.jpg') }}"/>
                                                </div>
                                                <div class="review-one__top">
                                                    <div class="review-one__name">Константин Константинопольский</div>
                                                    <div class="review-one__date">07.04.2019 в 12:00</div>
                                                    <div class="star-box">
                                                        <div data-mark="4"
                                                             data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                             data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                             class="star js_review star-fill hidden-mob"></div>
                                                    </div>

                                                </div>
                                                <div class="review-one-content content">
                                                    Специалист компании помог подобрать необходимые материалы и дал
                                                    несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5">
                                    <div class="write-review-box">
                                        <div class="h2">Оставьте свой отзыв</div>
                                        <form action="#" name="#" role="form" class="write-us-form js_validate">
                                            <div class="input-field form-star-box">
                                                <div data-mark="2"
                                                     data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                     data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                     class="star js_review-form star-fill hidden-mob"></div>
                                            </div>
                                            <div data-error="Required field" class="input-field required-field">
                                                <input id="input1" name="inputName" required type="text" tabindex="1"
                                                       placeholder=" " class="form-control">
                                                <label for="inputName" class="field-placeholder">Name</label><i
                                                        class="icon icon-user"></i>
                                            </div>
                                            <div data-error="Invalid email" class="input-field required-field">
                                                <input id="input2" name="inputEmail" required type="email" tabindex="2"
                                                       data-validate="email" placeholder=" " class="form-control">
                                                <label for="inputEmail" class="field-placeholder">E-mail</label><i
                                                        class="icon icon-union"></i>
                                            </div>
                                            <div data-error="Обязательное поле" class="form-field input-field">
                                            <textarea name="comment" required=""
                                                      placeholder="Напишите ваш комментарий..."
                                                      class="validate"></textarea><span class="pass-input"><i
                                                            class="icon icon-comment"></i></span>
                                            </div>
                                            <button type="submit" class="button-reset main-btn main-btn--green">оставить
                                                отзыв
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="benefits">
            <div class="benefits__gradient"></div>
            <div class="container">
                <div class="benefits__title">Подобные товары</div>
                <div class="slider-prod js-slider-prod">
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
{{--                    <div class="item">--}}
{{--                        @include('frontend.elements.productItem')--}}
{{--                    </div>--}}
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem') просто проверяла работу слайдера, при необходимости - разкомментить обратно, удалить статичную верстку--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <div class="item">
                        {{--                        @include('frontend.elements.productItem')--}}
                        <div class="item-prod">
                            <div class="prod-cart">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__addto">
                                    <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                    </button>
                                    <button class="button-reset prod-cart__addto-box"><i
                                                class="icon icon-bookmarks"></i></button>
                                </div>

                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8" (Италия)
                                        </div>
                                    </a></div>

                                <ul class="prod-cart__list">
                                    <li>Максимальное давление: 260 бар</li>
                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                    <li>Алюминиевый корпус</li>
                                    <li>Возможно секционное исполнение</li>
                                </ul>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill  "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
