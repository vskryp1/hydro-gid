@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/category.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
@endsection

@section('content')
    <main class="main">
        <div class="bg-top" style="background-image: url('{{ url('/assets/frontend/images/serv-bg.jpg') }}');">
            <div class="container">
                <div class="row">
                    @include('frontend.elements.breadcrumbs')
                </div>
            </div>
            <div class="container">
                <div class="products__title">
                    Гидромоторы шестерные
                </div>
            </div>
        </div>
        <div class="container">
            <div class="two-column-wrapper">
                <aside class="column-right filters-wrap">
                    @include('frontend.frontpage.subcategory.filters')
                </aside>
                <div class="container-main">
                    <div class="sorting-top">
                        <div class="sort-holder">
                            <label>Сортировать:</label>
                            <select name="" class="sort-select" data-placeholder="Популярность">
                                <option value="-1">Популярность</option>
                                <option value="0">Популярность</option>
                                <option value="1">Популярность</option>
                            </select>
                        </div>
                        <div class="choice-holder">
                            <label>Товаров на странице:</label>
                            <a class="item" href="#">16</a>
                            <a class="item" href="#">24</a>
                            <a class="item" href="#">36</a>
                            <a class="item" href="#">Все</a>
                        </div>
                    </div>
                    <div class="row category-product js_height-block">
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new not-available">277890 <span
                                                    class="val">грн</span></div>
                                    </div>
                                </div>
                                <div class="not-available-h">
                                    <span class="not-available-txt">Нет в наличии</span>
                                    <span class="report">Cообщить, когда появится</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new not-available">277890 <span
                                                    class="val">грн</span></div>
                                    </div>
                                </div>
                                <div class="not-available-h">
                                    <span class="not-available-txt">Нет в наличии</span>
                                    <span class="report">Cообщить, когда появится</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill"></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__order">
                                    <span class="ttl">Под заказ</span>
                                    <span class="discr">Срок поставки - 10 дней</span>
                                </div>

                                <a href="#" class="prod-cart__buy">заказать</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new not-available">277890 <span
                                                    class="val">грн</span></div>
                                    </div>
                                </div>
                                <div class="not-available-h">
                                    <span class="not-available-txt">Нет в наличии</span>
                                    <span class="report">Cообщить, когда появится</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__awaiting">
                                    <span class="ttl">Под заказ</span>
                                    <span class="discr">Срок поставки - 10 дней</span>
                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod out-stock col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new">277890 <span class="val">грн</span></div>
                                    </div>

                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                        <div class="item-prod out-stock col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__order">
                                    <span class="ttl">Под заказ</span>
                                    <span class="discr">Срок поставки - 10 дней</span>
                                </div>

                                <a href="#" class="prod-cart__buy">заказать</a>

                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__bottom">
                                    <div class="prod-cart__prise">
                                        <div class="prod-cart__prise-old">800 550 <span class="val">грн</span></div>
                                        <div class="prod-cart__prise-new not-available">277890 <span
                                                    class="val">грн</span></div>
                                    </div>
                                </div>
                                <div class="not-available-h">
                                    <span class="not-available-txt">Нет в наличии</span>
                                    <span class="report">Cообщить, когда появится</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-prod col-lg-3">
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
                                         class="star js_review star-fill "></div>
                                </div>
                                <div class="prod-cart__awaiting">
                                    <span class="ttl">Под заказ</span>
                                    <span class="discr">Срок поставки - 10 дней</span>
                                </div>
                                <a href="#" data-fancybox data-src="#modal-basket" class="prod-cart__buy">в корзину</a>

                            </div>
                        </div>
                    </div>
                    <a class="btn-see-more" href="#"><i class="icon icon-rotate"></i>Показать ещё</a>
                </div>
            </div>
        </div>
        <div class="benefits">
            <div class="benefits__gradient"></div>
            <div class="container">
                <div class="benefits__title">Вы просматривали ранее</div>
                <div class="slider-prod js-slider-prod">
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                    <div class="item">
                        @include('frontend.elements.productItem')
                    </div>
                </div>
            </div>
        </div>
        <div class="seo">
            <div class="container">
                <div class="seo__title">
                    Заголовок СЕО
                </div>
                <div class="sep__text-wrapper">
                    <div class="seo__text">
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection