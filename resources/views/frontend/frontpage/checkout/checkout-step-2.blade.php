@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/checkout.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
@endsection

@section('content')
    <main>
        <div class="checkout checkout-step-2">
            <div class="checkout__title">
                <div class="container">
                    Оформление заказа
                </div>
            </div>
            <div class="checkout__step-line">
                <div class="container">
                    <div class="checkout__step-item checkout__step-itemfirst">
                        1. Контактные данные
                    </div>
                    <div class="checkout__step-item checkout__step-item-2">
                        2. Выбор способа доставки и оплаты
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="checkout__inner">
                    <div class="checkout__content">
                        <div class="checkout__content-title done">
                            <span class="icon icon-check"></span> Контактные данные <a href="#">Редактировать <span class="icon icon-edit"></span> </a>
                        </div>
                        <div class="checkout__content-title">
                            <span>2</span> Выбор способа доставки и оплаты
                        </div>
                        <form class="checkout__radio-form js_validate checkout__checkbox" action='#'>
                            <div class="delivery">
                                <label class="radio">
                                    <input name="group1" type="radio" checked class="js__delivery-pickup">
                                    <span>Самовывоз из магазина</span>
                                </label>
                                <label class="radio">
                                    <input name="group1" type="radio" class="js__delivery-postofficeNP">
                                    <span>Самовывоз из Новой Почты</span>
                                </label>
                                <label class="radio">
                                    <input name="group1" type="radio" class="js__delivery-courier">
                                    <span>Курьер Новой Почты</span>
                                </label>
                                <label class="radio">
                                    <input name="group1" type="radio" class="js__delivery-postofficeOther">
                                    <span>Другие транспортные компании</span>
                                </label>
                            </div>

                            <div class="checkout__radio-box delivery-pickup" style='display: block;'>
                                <div class="checkout__radio-title">
                                    Самовывоз из магазина в Харькове
                                </div>
                                <section class="contacts__maps">
                                    <div class="checkout__radio-adress">
                                        Ул. Тарасовская, 21 Б <a class="js__map-toggle" href="#">Смотреть на карте <span class="icon icon-map"></span></a>
                                    </div>
                                </section>
                                <div class="delivery-map" id="map-pickup" data-coords="50.423411, 30.538572"></div>
                            </div>
                            <div class="checkout__radio-box delivery-postofficeNP" style='display: none;'>
                                <div class="checkout__radio-title">
                                    Самовывоз из Новой Почты
                                </div>
                                <div class="checkout__radio-group">
                                    <div class="checkout__radio-adress checkout__radio-adress-city">
                                        <div class="styled-select">
                                            <select>
                                                <option>Харьков</option>
                                                <option>Киев</option>
                                                <option>Одесса</option>
                                                <option>Херсон</option>
                                                <option>Запорожье</option>
                                                <option>Днепр</option>
                                                <option>Житомир</option>
                                                <option>Львов</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="checkout__radio-adress checkout__radio-adress-NP">
                                        <div class="styled-select">
                                            <select>
                                                <option>Отделение №1, ул. Киевская 23</option>
                                                <option>Отделение №2, ул. Харьковская 23</option>
                                                <option>Отделение №3, ул. Одесская 23</option>
                                                <option>Отделение №4, ул. Херсонская 23</option>
                                                <option>Отделение №5, ул. Запорожская 23</option>
                                                <option>Отделение №6, ул. Днепровская 23</option>
                                                <option>Отделение №7, ул. Житомирская 23</option>
                                                <option>Отделение №8, ул. Львовская 23</option>
                                            </select>
                                        </div>
                                        <section class="contacts__maps">
                                            <a class="js__map-toggle" href="#">Смотреть на карте <span class="icon icon-map"></span></a>
                                        </section>
                                    </div>
                                    <div class="delivery-map" id="map-pickup1" data-coords="50.423411, 30.538572"></div>
                                    <div class="checkout__radio-adress checkout__radio-adress-info">
                                        <span class="info">
                                            Грузоподъемность до 30 кг
                                        </span>
                                    </div>
                                    <div class="checkout__radio-adress checkout__radio-adress-schedule">
                                        <span class="title">
                                            График работы отделения:
                                        </span>
                                        <span class="info">
                                            <span class="day">Пн-Пт:</span>
                                            <span class="time">08:00-20:00</span>
                                        </span>
                                        <span class="info">
                                            <span class="day">Сб:</span>
                                            <span class="time">09:00-18:00</span>
                                        </span>
                                        <span class="info">
                                            <span class="day">Вс:</span>
                                            <span class="time">Выходной</span>
                                        </span>
                                        <span class="phone">
                                            <div class="footer__phone">
                                                <a href="tel:0676332353">
                                                    (067) 633 23 53
                                                </a>
                                                <a href="tel:0507023312">
                                                    (050) 702 33 12
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__radio-box delivery-courier" style='display: none;'>
                                <div class="checkout__radio-title">
                                    Курьер Новой Почты
                                </div>
                                <div class="checkout__radio-group">
                                    <div class="checkout__radio-adress checkout__radio-adress-city">
                                        <div class="styled-select">
                                            <select>
                                                <option>Харьков</option>
                                                <option>Киев</option>
                                                <option>Одесса</option>
                                                <option>Херсон</option>
                                                <option>Запорожье</option>
                                                <option>Днепр</option>
                                                <option>Житомир</option>
                                                <option>Львов</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="checkout__radio-adress checkout__radio-adress-adress">
                                        <span class="title">
                                            Ваш адрес:
                                        </span>
                                        <input type="text" placeholder="Улица*" required="">
                                        <input type="text" placeholder="Дом*" required="">
                                        <input type="text" placeholder="Квартира*" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__radio-box delivery-postofficeOther" style='display: none;'>
                                <div class="checkout__radio-title">
                                    Другая транспортная компания
                                </div>
                                <div class="checkout__radio-group">
                                    <div class="checkout__radio-adress checkout__radio-adress-city">
                                        <div class="styled-select">
                                            <select>
                                                <option>Харьков</option>
                                                <option>Киев</option>
                                                <option>Одесса</option>
                                                <option>Херсон</option>
                                                <option>Запорожье</option>
                                                <option>Днепр</option>
                                                <option>Житомир</option>
                                                <option>Львов</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="checkout__radio-adress checkout__radio-adress-NP">
                                        <div class="styled-select">
                                            <select>
                                                <option>Отделение №1, ул. Киевская 23</option>
                                                <option>Отделение №2, ул. Харьковская 23</option>
                                                <option>Отделение №3, ул. Одесская 23</option>
                                                <option>Отделение №4, ул. Херсонская 23</option>
                                                <option>Отделение №5, ул. Запорожская 23</option>
                                                <option>Отделение №6, ул. Днепровская 23</option>
                                                <option>Отделение №7, ул. Житомирская 23</option>
                                                <option>Отделение №8, ул. Львовская 23</option>
                                            </select>
                                        </div>
                                        <section class="contacts__maps">
                                            <a class="js__map-toggle" href="#">Смотреть на карте <span class="icon icon-map"></span></a>
                                        </section>
                                    </div>
                                    <div class="delivery-map" id="map-pickup3" data-coords="50.423411, 30.538572"></div>
                                    <div class="checkout__radio-adress checkout__radio-adress-info">
                                        <span class="info">
                                            Грузоподъемность до 30 кг
                                        </span>
                                    </div>
                                    <div class="checkout__radio-adress checkout__radio-adress-schedule">
                                        <span class="title">
                                            График работы отделения:
                                        </span>
                                        <span class="info">
                                            <span class="day">Пн-Пт:</span>
                                            <span class="time">08:00-20:00</span>
                                        </span>
                                        <span class="info">
                                            <span class="day">Сб:</span>
                                            <span class="time">09:00-18:00</span>
                                        </span>
                                        <span class="info">
                                            <span class="day">Вс:</span>
                                            <span class="time">Выходной</span>
                                        </span>
                                        <span>
                                            <div class="footer__phone">
                                                <a href="tel:0676332353">
                                                    (067) 633 23 53
                                                </a>
                                                <a href="tel:0507023312">
                                                    (050) 702 33 12
                                                </a>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="payment">
                                <div class="checkout__form-title">Оплата</div>
                                <label class="radio">
                                    <input name="group2" type="radio" checked>
                                    <span>Безналичный расчет</span>
                                </label>
                                <label class="radio">
                                    <input name="group2" type="radio">
                                    <span>Наличными</span>
                                </label>
                                <label class="radio">
                                    <input name="group2" type="radio" checked>
                                    <span>Visa/MasterCard</span>
                                </label>
                                <label class="radio">
                                    <input name="group2" type="radio">
                                    <span>Приват24</span>
                                </label>
                                <label class="radio">
                                    <input name="group2" type="radio">
                                    <span><img src="{{asset('/assets/frontend/images/liqpay.png')}}" alt=""></span>
                                </label>
                                <label class="radio">
                                    <input name="group2" type="radio">
                                    <span><img src="{{asset('/assets/frontend/images/pb.png')}}" alt=""> Оплата частями</span>
                                </label>
                            </div>
                            <button type="submit" class="checkout__step-next" >подтвердить заказ</button>
                        </form>
                    </div>


                    <div class="checkout__aside">
                        <div class="checkout__aside-title">
                            Ваш заказ
                        </div>
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8" (Италия)
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
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8" (Италия)
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
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img"
                                 src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3
                                    3/8" (Италия)
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
                        <a class="edit-order__link" href="#">Редактировать заказ</a>
                        <div class="basket__summarize-item">
                            <div class="basket__summarize-text">
                                3 товара на сумму
                            </div>
                            <div class="basket__summarize-prise">
                                800 550 <span>грн</span>
                            </div>
                        </div>
                        <div class="basket__summarize-item">
                            <div class="basket__summarize-text">
                                Скидка
                            </div>
                            <div class="basket__summarize-prise">
                                120 <span>грн</span>
                            </div>
                        </div>
                        <div class="basket__summarize-item">
                            <div class="basket__summarize-text">
                                Стоимость доставки
                            </div>
                            <div class="basket__summarize-prise">
                                500 <span>грн</span>
                            </div>
                        </div>
                        <div class="basket__total">
                            <div class="basket__total-text">
                                Итого
                            </div>
                            <div class="basket__total-prise">
                                800 550 <span>грн</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
