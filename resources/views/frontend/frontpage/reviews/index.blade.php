@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/reviews.min.css')) !!}
@endsection

@section('scripts')
    {!! Html::script(mix('/assets/frontend/js/category.js')) !!}
    @parent
@endsection

@section('content')
    <main>
        <div class="reviews">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="reviews__title page--line">
                <div class="container">
                    Отзывы
                </div>
            </div>
            <div class="container">
                <div class="reviews__inner">
                    <div class="reviews__content">
                        <div class="reviews__item">
                            <div class="reviews__item-img">
                                <img src="{{asset('assets/frontend/images/user.jpg') }}" alt="">
                            </div>
                            <div class="reviews__item-box">
                                <div class="reviews__item-name">
                                    Константин Константинопольский
                                </div>
                                <div class="reviews__item-date">
                                    07.04.2019 в 12:00
                                </div>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob">
                                    </div>
                                </div>
                                <div class="reviews__item-text">
                                    Специалист компании помог подобрать необходимые материалы и дал несколько
                                    рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                </div>
                            </div>
                        </div>
                        <div class="reviews__item">
                            <div class="reviews__item-img">
                                <img src="{{asset('assets/frontend/images/user.jpg') }}" alt="">
                            </div>
                            <div class="reviews__item-box">
                                <div class="reviews__item-name">
                                    Константин Константинопольский
                                </div>
                                <div class="reviews__item-date">
                                    07.04.2019 в 12:00
                                </div>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob">
                                    </div>
                                </div>
                                <div class="reviews__item-text">
                                    Специалист компании помог подобрать необходимые материалы и дал несколько
                                    рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                </div>
                            </div>
                        </div>
                        <div class="reviews__item answer">
                            <div class="reviews__item-img">
                                <img src="{{asset('assets/frontend/images/user.jpg') }}" alt="">
                            </div>
                            <div class="reviews__item-box">
                                <div class="reviews__item-name">
                                    Константин Константинопольский
                                </div>
                                <div class="reviews__item-date">
                                    07.04.2019 в 12:00
                                </div>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob">
                                    </div>
                                </div>
                                <div class="reviews__item-text">
                                    Специалист компании помог подобрать необходимые материалы и дал несколько
                                    рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
                                </div>
                            </div>
                        </div>
                        <div class="reviews__item-answer">
                            <div class="reviews__item-box">
                                <div class="reviews__item-name">
                                    Ответ администратора
                                </div>
                                <div class="reviews__item-date">
                                    07.04.2019 в 12:00
                                </div>
                                <div class="reviews__item-text">
                                    Специалист компании помог подобрать необходимые материалы и дал несколько
                                    рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо.Будем рекомендовать. Скоро заедем
                                    с соседом по участку.
                                </div>
                            </div>
                        </div>
                        <div class="reviews__item">
                            <div class="reviews__item-img">
                                <img src="{{asset('assets/frontend/images/user.jpg') }}" alt="">
                            </div>
                            <div class="reviews__item-box">
                                <div class="reviews__item-name">
                                    Константин Константинопольский
                                </div>
                                <div class="reviews__item-date">
                                    07.04.2019 в 12:00
                                </div>
                                <div class="star-box">
                                    <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                         data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                         class="star js_review star-fill hidden-mob">
                                    </div>
                                </div>
                                <div class="reviews__item-text">
                                    Специалист компании помог подобрать необходимые материалы и дал несколько
                                    рекомендаций.Не зря свой хлеб ест. Ещё раз спасибо
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
                    <div class="reviews__form">
                        <div class="reviews__form-title">
                            Оставьте свой отзыв
                        </div>
                        <div class="star-box">
                            <div data-mark="4" data-star-on="{{asset('assets/frontend/images/on.svg') }}"
                                 data-star-off="{{asset('assets/frontend/images/off.svg') }}"
                                 class="star js_review star-fill hidden-mob"></div>
                        </div>
                        <label>
                            <input type="text" placeholder="Ваше имя*">
                            <i class="icon icon-user"></i>
                        </label>
                        <label>
                            <input type="text" placeholder="Ваш E-mail*">
                            <i class="icon icon-union"></i>
                        </label>
                        <label>
                            <textarea placeholder="Напишите ваш комментарий..."></textarea>
                            <i class="icon icon-comment"></i>
                        </label>
                        <button type="submit">оставить отзыв</button>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection