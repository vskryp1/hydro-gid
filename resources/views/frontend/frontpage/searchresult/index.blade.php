@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/searchresult.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/searchresult.js')) !!}
@endsection

@section('content')
    <main class="searchresult">
        <div class="blog">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Результаты поиска</a></li>
                    </ul>
                </div>
            </div>
            <div class="blog__title page--line">
                <div class="container">
                    Найдено 107 товаров по запросу: “Гидро”
                </div>
            </div>
            <div class="tab-general-box tab-area">
                <div class="container">
                    <ul class="tab-navigation flex-wrap tab-fill">
                        <li><a href="#feature-all-1" class="active"><span class="tab-item">товары (69)</span></a></li>
                        <li><a href="#feature-all-2"><span class="tab-item">статьи (14)</span></a></li>
                    </ul>
                    <div class="tab-container">
                        <div id="feature-all-2" class="tab-box">
                            <div class="blog__items row">
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                    <div class="blog__item">
                                        <a href="#">
                                            <div class="blog__item-img">
                                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                            </div>
                                            <div class="blog__item-title">
                                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой
                                                версии
                                                Стандарта ISO
                                                9001.
                                            </div>
                                            <div class="blog__item-date">
                                                <span class="icon icon-bookmarks"></span> 27 октября 2019
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ul class="pagination">
                                <li class="disabled">
                                    <span class="arrow" aria-hidden="true">&lsaquo; <span>Назад</span></span>
                                </li>
                                <li>
                                    <a href="#" rel="prev">1</a>
                                </li>
                                <li>
                                    <a href="#" rel="prev">2</a>
                                </li>
                                <li class="active">
                                    <a href="#" rel="prev">3</a>
                                </li>
                                <li>
                                    <a href="#" rel="prev">4</a>
                                </li>
                                <li>
                                    <a href="#" rel="prev">5</a>
                                </li>
                                <li>
                                    <a class="arrow" href="#" rel="prev"><span>Вперед</span> &rsaquo;</a>
                                </li>
                            </ul>
                        </div>
                        <div id="feature-all-1" class="tab-box">
                            <div class="flex-container">
                                <aside class="list-menu">
                                    <ul>
                                        <li>
                                            <a href="#" class="active">Все товары <span>(16)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Гидравлические насосы <span>(16)</span></a>
                                        </li>
                                        <li>
                                            <a href="#">Гидрораспределители <span>(16)</span></a>
                                        </li>
                                    </ul>
                                </aside>
                                <div class="main_container">
                                    <div class="row category-product js_height-block">
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__awaiting">
                                                    <span class="ttl">Под заказ</span>
                                                    <span class="discr">Срок поставки - 10 дней</span>
                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod out-stock col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
                                                        <div class="prod-cart__prise-new">277890 <span
                                                                    class="val">грн</span></div>
                                                    </div>

                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                        <div class="item-prod out-stock col-lg-3">
                                            <div class="prod-cart">
                                                <div class="prod-cart__status">
                                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                                </div>
                                                <div class="prod-cart__addto">
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__bottom">
                                                    <div class="prod-cart__prise">
                                                        <div class="prod-cart__prise-old">800 550 <span
                                                                    class="val">грн</span></div>
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
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-balance"></i></button>
                                                    <button class="button-reset prod-cart__addto-box"><i
                                                                class="icon icon-bookmarks"></i></button>
                                                </div>

                                                <div class="prod-cart__top"><a href="#">
                                                        <div class="prod-cart__img"><img
                                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                                        </div>
                                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со
                                                            сбросом в
                                                            бак RFP3 3/8" (Италия)
                                                        </div>
                                                    </a></div>

                                                <ul class="prod-cart__list">
                                                    <li>Максимальное давление: 260 бар</li>
                                                    <li>Максимальный рабочий объем: 91 см3/об</li>
                                                    <li>Алюминиевый корпус</li>
                                                    <li>Возможно секционное исполнение</li>
                                                </ul>
                                                <div class="star-box">
                                                    <div data-mark="4"
                                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                                         class="star js_review star-fill hidden-mob"></div>
                                                </div>
                                                <div class="prod-cart__awaiting">
                                                    <span class="ttl">Под заказ</span>
                                                    <span class="discr">Срок поставки - 10 дней</span>
                                                </div>
                                                <a href="#" class="prod-cart__buy">в корзину</a>

                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn-see-more" href="#"><i class="icon icon-rotate"></i>Показать ещё</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection