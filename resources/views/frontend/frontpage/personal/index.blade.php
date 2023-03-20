@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/personal.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/personal.js')) !!}
@endsection

@section('content')
    <main>
        <div class="personal">
            <div class="personal__title">
                <div class="container">
                    Личный кабинет
                </div>
            </div>
            <div class="container">
                <div class="personal__tabs header__tabs">
                    <div id="details" class="personal__tab active">Мои данные</div>
                    <div id="delivery" class="personal__tab">Данные доставки</div>
                    <div id="orders" class="personal__tab">Мои заказы</div>
                    <div id="wish-list" class="personal__tab">Список желаний</div>
                    <div id="waiting-list" class="personal__tab">Лист ожидания</div>
                    <div id="reviews" class="personal__tab">Мои отзывы</div>
                </div>

                <div class="personal__content content__tabs">
                    <div class="details personal__tab-content">
                        <div class="personal-discount">
                            <div class="personal-discount-number">
                                5%
                            </div>
                            <div class="personal-discount-text">
                                Персональная скидка
                            </div>
                        </div>
                        <div class="personal__tab-title">Мои данные</div>
                        <form class="js_filters">
                            <div class="filter__items checkbox">
                                <div class="filter-area">
                                    <input type="checkbox" name="fltr-1" id="fltr-1">
                                    <label for="fltr-1">Я являюсь юридическим лицом</label>
                                </div>
                            </div>
                            <div class="details__input">
                                <div class="details__input-col">
                                    <label class="personal__label">Имя</label>
                                    <input class="personal__input" type="text" placeholder="Александр">
                                    <label class="personal__label">Фамилия</label>
                                    <input class="personal__input" type="text" placeholder="Константинов">
                                    <label class="personal__label">Ваш E-mail</label>
                                    <input class="personal__input" type="email" placeholder="Ваш E-mail">
                                </div>
                                <div class="details__input-col">
                                    <label class="personal__label">Ваш телефон</label>
                                    <input class="personal__input" type="text" placeholder="(095) 092 93 17">
                                    <label class="personal__label">Название компании</label>
                                    <input class="personal__input" type="text" placeholder="Название вашей компании">
                                    <label class="personal__label">Код ЕГРПОУ</label>
                                    <input class="personal__input" type="email" placeholder="Код ЕГРПОУ">
                                </div>
                            </div>
                            <a class="change-password" data-fancybox="" data-src="#modal-pass" href="#">Cменить пароль</a>
                            <div class="personal__edit">
                                <button>редактировать</button>
                            </div>
                        </form>
                    </div>

                    <div class="delivery personal__tab-content">
                        <div class="personal__tab-title">Данные доставки</div>
                        <form class="js_filters">
                            <div class="details__input">
                                <div class="details__input-col">
                                    <label class="personal__label">Город</label>
                                    <input class="personal__input" type="text" placeholder="Харьков">
                                    <label class="personal__label">Улица</label>
                                    <input class="personal__input" type="text" placeholder="Франтишека Крала">
                                    <label class="personal__label">Дом, квартира</label>
                                    <input class="personal__input" type="email" placeholder="Дом 48, квартира 48">
                                </div>
                            </div>
                            <div class="personal__edit">
                                <button>редактировать</button>
                            </div>
                        </form>
                    </div>

                    <div class="orders personal__tab-content">
                        <div class="current-order">
                            <div class="personal__tab-title">Текущий заказ</div>
                            <div class="current-order__items">
                                <div class="current-order__items-title order">
                                    <div class="order__img">

                                    </div>
                                    <div class="order__text">
                                        Товар
                                    </div>
                                    <div class="order__price">
                                        Цена
                                    </div>
                                    <div class="order__sum">
                                        Кол-во
                                    </div>
                                    <div class="order__value">
                                        Стоимость
                                    </div>
                                    <div class="order__status">
                                        Статус
                                    </div>
                                    <div class="order__track">

                                    </div>
                                </div>
                                <div class="current-order__item-inner">
                                    <div class="current-order__item order">
                                        <div class="order__img">
                                            <img src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                                 alt="">
                                        </div>
                                        <div class="order__text">
                                            Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                        </div>
                                        <div class="order__price">
                                            120 230 грн
                                        </div>
                                        <div class="order__sum">
                                            100
                                        </div>
                                        <div class="order__value">
                                            120 230 грн
                                        </div>
                                        <div class="order__status">
                                            Отправлен
                                        </div>
                                        <div class="order__track">
                                            отследить заказ
                                        </div>
                                    </div>
                                    <div class="current-order__item order">
                                        <div class="order__img">
                                            <img src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                                 alt="">
                                        </div>
                                        <div class="order__text">
                                            Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                        </div>
                                        <div class="order__price">
                                            120 230 грн
                                        </div>
                                        <div class="order__sum">
                                            100
                                        </div>
                                        <div class="order__value">

                                        </div>
                                        <div class="order__status">

                                        </div>
                                        <div class="order__track">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="order-history">
                            <div class="personal__tab-title">История заказов</div>
                            <div class="current-order__items-title history-order__items-title order">
                                <div class="order__data">
                                    Дата
                                </div>
                                <div class="order__text">
                                    Товар
                                </div>
                                <div class="order__vendor-code">
                                    Артикул
                                </div>
                                <div class="order__price">
                                    Цена
                                </div>
                                <div class="order__sum">
                                    Кол-во
                                </div>
                                <div class="order__value">
                                    Стоимость
                                </div>
                                <div class="order__status">
                                    Статус
                                </div>
                                <a href="#" class="order__track">

                                </a>
                            </div>
                            <div class="current-order__item-inner">
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        3 позиции в заказе
                                    </div>
                                    <div class="order__vendor-code">

                                    </div>
                                    <div class="order__price">

                                    </div>
                                    <div class="order__sum">

                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status paid">
                                        оплачен
                                    </div>
                                    <a href="#" class="order__track">

                                    </a>
                                </div>
                                <div class="current-order__item order-history__item order">
                                    <div class="order__data">
                                        14.02.2019
                                    </div>
                                    <div class="order__text">
                                        Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                    </div>
                                    <div class="order__vendor-code">
                                        23414145
                                    </div>
                                    <div class="order__price">
                                        120 230 грн
                                    </div>
                                    <div class="order__sum">
                                        1
                                    </div>
                                    <div class="order__value">
                                        120 230 грн
                                    </div>
                                    <div class="order__status not-paid">
                                        Не оплачен
                                    </div>
                                    <a href="#" class="order__track">
                                        Оплатить
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wish-list personal__tab-content">
                        <div class="personal__tab-title">Список желаний</div>
                        <div class="row category-product js_height-block">
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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

                    <div class="waiting-list personal__tab-content">
                        <div class="personal__tab-title">Лист ожидания</div>
                        <div class="row category-product js_height-block">
                            <div class="item-prod col-lg-3">
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                                <div class="prod-cart height">
                                    <div class="prod-cart__status">
                                        <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                    </div>
                                    <div class="prod-cart__addto">
                                        <button class="button-reset prod-cart__addto-box"><i
                                                    class="icon icon-delete"></i></button>
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
                                             class="star js_review star-fill hidden-mob"></div>
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
                        </div>

                    </div>

                    <div class="reviews personal__tab-content">
                        <div class="personal__tab-title">Мои отзывы</div>
                        <div class="personal__reviews">
                            <div class="personal__reviews-box">
                                <div class="personal__reviews-item">
                                    <div class="personal__reviews-element">
                                        <div class="personal__reviews-img">
                                            <img src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                                 alt="">
                                        </div>
                                        <div class="personal__reviews-info">
                                            <div class="personal__reviews-title">
                                                Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                            </div>
                                            <div class="personal__component-title">
                                                Константин Константинопольский
                                                <div class="icon icon-comment"></div>
                                            </div>
                                            <div class="personal__component-date">
                                                08.04.2019 в 12:00
                                            </div>
                                            <div class="star-box">
                                                <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}" data-star-off="{{asset('assets/frontend/images/off.svg') }}" class="star js_review star-fill hidden-mob"></div>
                                            </div>
                                            <div class="personal__reviews-text">
                                                Специалист компании помог подобрать необходимые материалы и дал
                                                несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем
                                                рекомендовать. Скоро заедем с соседом по
                                                участку.
                                            </div>
                                        </div>
                                        <div class="personal__reviews-btn">
                                            <span class="icon icon-arrow-down"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal__reviews-component">
                                    <div class="personal__component-inner">
                                        <div class="personal__component-title">
                                            Ответ администратора
                                        </div>
                                        <div class="personal__component-date">
                                            07.04.2019 в 12:00
                                        </div>
                                        <div class="personal__component-text">
                                            Специалист компании помог подобрать необходимые материалы и дал несколько
                                            рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем рекомендовать.
                                            Скоро заедем с соседом по
                                            участку.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="personal__reviews-box">
                                <div class="personal__reviews-item">
                                    <div class="personal__reviews-element">
                                        <div class="personal__reviews-img">
                                            <img src="{{asset('/assets/frontend/images/content/content-item.png')}}"
                                                 alt="">
                                        </div>
                                        <div class="personal__reviews-info">
                                            <div class="personal__reviews-title">
                                                Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                            </div>
                                            <div class="personal__component-title">
                                                Константин Константинопольский
                                                <div class="icon icon-comment"></div>
                                            </div>
                                            <div class="personal__component-date">
                                                08.04.2019 в 12:00
                                            </div>
                                            <div class="star-box">
                                                <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}" data-star-off="{{asset('assets/frontend/images/off.svg') }}" class="star js_review star-fill hidden-mob"></div>
                                            </div>
                                            <div class="personal__reviews-text">
                                                Специалист компании помог подобрать необходимые материалы и дал
                                                несколько рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем
                                                рекомендовать. Скоро заедем с соседом по
                                                участку.
                                            </div>
                                        </div>
                                        <div class="personal__reviews-btn">
                                            <span class="icon icon-arrow-down"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="personal__reviews-component">
                                    <div class="personal__component-inner">
                                        <div class="personal__component-title">
                                            Ответ администратора
                                        </div>
                                        <div class="personal__component-date">
                                            07.04.2019 в 12:00
                                        </div>
                                        <div class="personal__component-text">
                                            Специалист компании помог подобрать необходимые материалы и дал несколько
                                            рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем рекомендовать.
                                            Скоро заедем с соседом по
                                            участку.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="personal__reviews-box">
                            <div class="personal__reviews-item">
                                <div class="personal__reviews-element">
                                    <div class="personal__reviews-img">
                                        <img src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                                    </div>
                                    <div class="personal__reviews-info">
                                        <div class="personal__reviews-title">
                                            Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                                        </div>
                                        <div class="personal__component-title">
                                            Константин Константинопольский
                                            <div class="icon icon-comment"></div>
                                        </div>
                                        <div class="personal__component-date">
                                            08.04.2019 в 12:00
                                        </div>
                                        <div class="star-box">
                                            <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}" data-star-off="{{asset('assets/frontend/images/off.svg') }}" class="star js_review star-fill hidden-mob"></div>
                                        </div>
                                        <div class="personal__reviews-text">
                                            Специалист компании помог подобрать необходимые материалы и дал несколько
                                            рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем рекомендовать.
                                            Скоро заедем с соседом по
                                            участку.
                                        </div>
                                    </div>
                                    <div class="personal__reviews-btn">
                                        <span class="icon icon-arrow-down"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="personal__reviews-component">
                                <div class="personal__component-inner">
                                    <div class="personal__component-title">
                                        Ответ администратора
                                    </div>
                                    <div class="personal__component-date">
                                        07.04.2019 в 12:00
                                    </div>
                                    <div class="personal__component-text">
                                        Специалист компании помог подобрать необходимые материалы и дал несколько
                                        рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем рекомендовать. Скоро
                                        заедем с соседом по участку.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection