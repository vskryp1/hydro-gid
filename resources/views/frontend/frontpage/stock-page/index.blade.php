@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/stock-page.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="page--line stock-page__top">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="stock-page__inner">
            <div class="container">
                <div class="stock-page__item">
                    <div class="stock-page__title">
                        Супер цена! Длинный заголовок, возможно на две строки
                    </div>
                    <div class="stock-page__info">
                        <span class="icon-time icon"></span> Акция действует c 27 октября 2019 по 27 октября 2019
                    </div>
                    <div class="stock-page__item-content">
                        <div class="stock-page__item-img">
                            <img src="{{asset('assets/frontend/images/content/stock.png')}}" alt="">
                        </div>
                        <div class="stock-page__item-text">
                            Таким образом консультация с широким активом позволяет выполнять важные задания по
                            разработке дальнейших направлений развития. Не следует, однако забывать, что дальнейшее
                            развитие различных форм деятельности требуют определения и уточнения существенных финансовых
                            и административных условий. Не следует, однако забывать, что постоянное
                            информационно-пропагандистское обеспечение нашей деятельности в значительной степени
                            обуславливает создание модели развития. Повседневная практика показывает, что рамки и место
                            обучения кадров требуют от нас анализа новых предложений. С другой стороны постоянное
                            <div class="stock-page__item-btn">
                                <a href="#">Смотреть акионные товары</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stock-page__title-product">
                    Акционные товары
                </div>
                <div class="row category-product js_height-block">
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
                    <div class="item-prod col-5">
                        <div class="prod-cart">
                            <div class="prod-cart__status">
                                <div class="prod-cart__status-box"><span>Распродажа</span></div>
                            </div>
                            <div class="prod-cart__addto">
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-balance"></i>
                                </button>
                                <button class="button-reset prod-cart__addto-box"><i class="icon icon-bookmarks"></i>
                                </button>
                            </div>

                            <div class="prod-cart__top"><a href="#">
                                    <div class="prod-cart__img"><img
                                                src="{{asset('assets/frontend/images/img01.jpg') }}"/></div>
                                    <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                        3/8" (Италия)
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
                                     class="star js_review star-fill hidden-mob"></div>
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
    </main>
@endsection