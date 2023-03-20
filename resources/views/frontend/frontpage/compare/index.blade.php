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
        <div id="table-scroll" class="table-scroll">
            <div class="table-wrap">
                <table class="main-table js_height-block">
                    <thead>
                    <tr>
                        <th class="fixed-side height" scope="col">

                            <form method="post" action="#">
                                <a href="#" class="btn-delete"><i class="icon icon-delete"></i>Удалить сравнение</a>
                                <a href="#" class="btn-back"><i class="icon icon-arrow-long"></i>Назад</a>
                                <div class="filter__items checkbox">
                                    <div class="filter-area">
                                        <input type="checkbox" name="fltr-4" id="fltr-3">
                                        <label for="fltr-3">Показывать только отличия</label>
                                    </div>
                                </div>
                            </form>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>

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
                            </div>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>
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
                            </div>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>
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
                            </div>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>
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
                            </div>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>
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
                            </div>
                        </th>
                        <th scope="col" class="col">
                            <i class="icon icon-delete js-btn-close"></i>
                            <div class="prod-cart height">
                                <div class="prod-cart__status">
                                    <div class="prod-cart__status-box"><span>Распродажа</span></div>
                                </div>
                                <div class="prod-cart__top"><a href="#">
                                        <div class="prod-cart__img"><img
                                                    src="{{asset('assets/frontend/images/img01.jpg') }}"/>
                                        </div>
                                        <div class="prod-cart__descr">Регулятор расхода 3х линейный со сбросом в бак
                                            RFP3 3/8"
                                            (Италия)
                                        </div>
                                    </a></div>
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
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    <tr>
                        <th class="fixed-side"><span>Характеристика</span></th>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                        <td><span>Значение</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection