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
        <div class="checkout">

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
                    <div class="checkout__step-item">
                        2. Выбор способа доставки и оплаты
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="checkout__inner">
                    <div class="checkout__content">
                        <div class="checkout__btn">
                            <a class="active" href="#">Я новый покупатель</a>
                            <a href="#">Я постоянный клиент</a>
                        </div>
                        <div class="checkout__content-title">
                            <span>1</span>Контактные данные
                        </div>
                        <div class="checkout__checkbox">
                            <form class="js_filters">
                                <div class="filter__items checkbox">
                                    <div class="filter-area">
                                        <input type="checkbox" name="fltr-1" id="fltr-1">
                                        <label for="fltr-1">Я являюсь юридическим лицом</label>
                                    </div>
                                </div>
                                <div class="checkout__field">
                                    <input type="text" placeholder="Имя*" required>
                                    <input type="text" placeholder="Фамилия*" required>
                                    <input type="number" placeholder="Телефон*" required>
                                    <input type="email" placeholder="E-mail*" required>
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
                                    <div class="checkout__select-link">
                                        <span>Киев</span>
                                        <span>Одесса</span>
                                        <span>Херсон</span>
                                        <span>Запорожье</span>
                                        <span>Днепр</span>
                                        <span>Житомир</span>
                                        <span>Львов</span>
                                    </div>
                                    <input type="text" placeholder="Название компании*" required>
                                    <input type="text" placeholder="Код ЕГРПОУ*" required>
                            </form>
                        </div>
                        <a disabled="disabled" class="checkout__step-next disabled" href="#">перейти к доставке и оплате</a>
                    </div>
                    <div class="checkout__content-title not-active">
                        <span>2</span> Выбор способа доставки и оплаты
                    </div>
                </div>
                <div class="checkout__aside">
                    <div class="checkout__aside-title">
                        Ваш заказ
                    </div>
                    <div class="checkout__aside-item">
                        <img class="checkout__aside-img"
                             src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                        <div class="checkout__aside-info">
                            <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8"
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
                    <div class="checkout__aside-item">
                        <img class="checkout__aside-img"
                             src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                        <div class="checkout__aside-info">
                            <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8"
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
                    <div class="checkout__aside-item">
                        <img class="checkout__aside-img"
                             src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                        <div class="checkout__aside-info">
                            <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8"
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
    </main>
@endsection