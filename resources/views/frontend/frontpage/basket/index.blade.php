@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/basket.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/product.js')) !!}
@endsection

@section('content')
    <main>
        <div class="basket">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>

            <div class="basket__title">
                <div class="container">
                    Корзина
                </div>
            </div>
            <div class="container">
            <div class="basket__inner">
                <div class="basket__items">
                    <div class="basket__item">
                        <a class="basket__item-delate" href="#">
                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5C0 4.44772 0.447715 4 1 4H19C19.5523 4 20 4.44772 20 5C20 5.55228 19.5523 6 19 6H1C0.447715 6 0 5.55228 0 5Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2H8ZM15 4V3C15 2.20435 14.6839 1.44129 14.1213 0.87868C13.5587 0.31607 12.7956 0 12 0H8C7.20435 0 6.44129 0.31607 5.87868 0.87868C5.31607 1.44129 5 2.20435 5 3V4H3C2.44772 4 2 4.44772 2 5V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H15C15.7957 22 16.5587 21.6839 17.1213 21.1213C17.6839 20.5587 18 19.7957 18 19V5C18 4.44772 17.5523 4 17 4H15ZM4 6V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H15C15.2652 20 15.5196 19.8946 15.7071 19.7071C15.8946 19.5196 16 19.2652 16 19V6H4Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C8.55228 9 9 9.44771 9 10V16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16V10C7 9.44771 7.44772 9 8 9Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 9C12.5523 9 13 9.44771 13 10V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V10C11 9.44771 11.4477 9 12 9Z" fill="#AAADBB"/>
                            </svg>
                        </a>
                        <img class="basket__item-img" src="{{asset('/assets/frontend/images/cart-images.png')}}" alt="">
                        <div class="basket__item-info">
                            <div class="basket__item-text">
                                Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                            </div>
                            <div class="basket__item-rating">
                                <div class="star-box">
                                    <div data-mark="4"
                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob"></div>
                                </div>
                            </div>
                            <div class="basket__item-vendor">
                                Артикул: <span>23414145</span>
                                <i class="icon icon-copy"></i>
                            </div>
                        </div>
                        <div class="basket__item-summ">
                            <div class="quantity-cart basket__quantity-cart js_quantity">
                                <span class="js_minus btn-count btn-count--minus">-</span>
                                <input type="text" class="js-changeAmount count" value="5" readonly="">
                                <span class="js_plus btn-count btn-count--plus">+</span>
                            </div>
                        </div>
                        <div class="basket__item-prise">
                            800 550 <span>грн</span>
                        </div>
                    </div>
                    <div class="basket__item">
                        <a class="basket__item-delate" href="#">
                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5C0 4.44772 0.447715 4 1 4H19C19.5523 4 20 4.44772 20 5C20 5.55228 19.5523 6 19 6H1C0.447715 6 0 5.55228 0 5Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2H8ZM15 4V3C15 2.20435 14.6839 1.44129 14.1213 0.87868C13.5587 0.31607 12.7956 0 12 0H8C7.20435 0 6.44129 0.31607 5.87868 0.87868C5.31607 1.44129 5 2.20435 5 3V4H3C2.44772 4 2 4.44772 2 5V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H15C15.7957 22 16.5587 21.6839 17.1213 21.1213C17.6839 20.5587 18 19.7957 18 19V5C18 4.44772 17.5523 4 17 4H15ZM4 6V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H15C15.2652 20 15.5196 19.8946 15.7071 19.7071C15.8946 19.5196 16 19.2652 16 19V6H4Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C8.55228 9 9 9.44771 9 10V16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16V10C7 9.44771 7.44772 9 8 9Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 9C12.5523 9 13 9.44771 13 10V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V10C11 9.44771 11.4477 9 12 9Z" fill="#AAADBB"/>
                            </svg>
                        </a>
                        <img class="basket__item-img" src="{{asset('/assets/frontend/images/cart-images.png')}}" alt="">
                        <div class="basket__item-info">
                            <div class="basket__item-text">
                                Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                            </div>
                            <div class="basket__item-rating">
                                <div class="star-box">
                                    <div data-mark="4"
                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob"></div>
                                </div>
                            </div>
                            <div class="basket__item-vendor">
                                Артикул: <span>23414145</span>
                                <i class="icon icon-copy"></i>
                            </div>
                        </div>
                        <div class="basket__item-summ">
                            <div class="quantity-cart basket__quantity-cart js_quantity">
                                <span class="js_minus btn-count btn-count--minus">-</span>
                                <input type="text" class="js-changeAmount count" value="5" readonly="">
                                <span class="js_plus btn-count btn-count--plus">+</span>
                            </div>
                        </div>
                        <div class="basket__item-prise">
                            800 550 <span>грн</span>
                        </div>
                    </div>
                    <div class="basket__item">
                        <a class="basket__item-delate" href="#">
                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5C0 4.44772 0.447715 4 1 4H19C19.5523 4 20 4.44772 20 5C20 5.55228 19.5523 6 19 6H1C0.447715 6 0 5.55228 0 5Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2H8ZM15 4V3C15 2.20435 14.6839 1.44129 14.1213 0.87868C13.5587 0.31607 12.7956 0 12 0H8C7.20435 0 6.44129 0.31607 5.87868 0.87868C5.31607 1.44129 5 2.20435 5 3V4H3C2.44772 4 2 4.44772 2 5V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H15C15.7957 22 16.5587 21.6839 17.1213 21.1213C17.6839 20.5587 18 19.7957 18 19V5C18 4.44772 17.5523 4 17 4H15ZM4 6V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H15C15.2652 20 15.5196 19.8946 15.7071 19.7071C15.8946 19.5196 16 19.2652 16 19V6H4Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C8.55228 9 9 9.44771 9 10V16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16V10C7 9.44771 7.44772 9 8 9Z" fill="#AAADBB"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 9C12.5523 9 13 9.44771 13 10V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V10C11 9.44771 11.4477 9 12 9Z" fill="#AAADBB"/>
                            </svg>
                        </a>
                        <img class="basket__item-img" src="{{asset('/assets/frontend/images/cart-images.png')}}" alt="">
                        <div class="basket__item-info">
                            <div class="basket__item-text">
                                Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)
                            </div>
                            <div class="basket__item-rating">
                                <div class="star-box">
                                    <div data-mark="4"
                                         data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob"></div>
                                </div>
                            </div>
                            <div class="basket__item-vendor">
                                Артикул: <span>23414145</span>
                                <i class="icon icon-copy"></i>
                            </div>
                        </div>
                        <div class="basket__item-summ">
                            <div class="quantity-cart basket__quantity-cart js_quantity">
                                <span class="js_minus btn-count btn-count--minus">-</span>
                                <input type="text" class="js-changeAmount count" value="5" readonly="">
                                <span class="js_plus btn-count btn-count--plus">+</span>
                            </div>
                        </div>
                        <div class="basket__item-prise">
                            800 550 <span>грн</span>
                        </div>
                    </div>
                    <a class="basket__clear" href="#">
                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5C0 4.44772 0.447715 4 1 4H19C19.5523 4 20 4.44772 20 5C20 5.55228 19.5523 6 19 6H1C0.447715 6 0 5.55228 0 5Z" fill="#AAADBB"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2H8ZM15 4V3C15 2.20435 14.6839 1.44129 14.1213 0.87868C13.5587 0.31607 12.7956 0 12 0H8C7.20435 0 6.44129 0.31607 5.87868 0.87868C5.31607 1.44129 5 2.20435 5 3V4H3C2.44772 4 2 4.44772 2 5V19C2 19.7957 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 22 5 22H15C15.7957 22 16.5587 21.6839 17.1213 21.1213C17.6839 20.5587 18 19.7957 18 19V5C18 4.44772 17.5523 4 17 4H15ZM4 6V19C4 19.2652 4.10536 19.5196 4.29289 19.7071C4.48043 19.8946 4.73478 20 5 20H15C15.2652 20 15.5196 19.8946 15.7071 19.7071C15.8946 19.5196 16 19.2652 16 19V6H4Z" fill="#AAADBB"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 9C8.55228 9 9 9.44771 9 10V16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16V10C7 9.44771 7.44772 9 8 9Z" fill="#AAADBB"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 9C12.5523 9 13 9.44771 13 10V16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16V10C11 9.44771 11.4477 9 12 9Z" fill="#AAADBB"/>
                        </svg>
                        очистить корзину
                    </a>
                </div>
                <div class="basket__summarize">
                    <div class="basket__summarize-title">
                        Ваша корзина
                    </div>
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
                            Стоимость доставки
                        </div>
                        <div class="basket__summarize-prise">
                            60 <span>грн</span>
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
                    <a class="basket__summarize-btn" href="#">
                        перейти к оформлению заказа
                    </a>
                </div>
            </div>
            </div>
        </div>
    </main>
@endsection