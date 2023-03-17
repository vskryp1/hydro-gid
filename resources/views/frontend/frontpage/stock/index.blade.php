@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/stock.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="stock">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="stock__title page--line">
                <div class="container">
                    Акции
                </div>
            </div>
            <div class="container">
                <div class="stock__inner">
                    <div class="stock__items">
                        <div class="stock__item">
                            <div class="stock__item-img">
                                <img src="{{asset('assets/frontend/images/content/stock.png')}}" alt="">
                            </div>
                            <div class="stock__item-content">
                                <div class="stock__item-title">
                                    Супер цена! Длинный заголовок, возможно на две строки
                                </div>
                                <div class="stock__item-info">
                                    <span class="icon-time icon"></span> Акция действует c 01.11.2019 по 31.12.2019
                                </div>
                                <div class="stock__item-text">
                                    Все мы с Вами слышали о существовании такой замечательной вещи, как принтер. Он
                                    обеспечивает нам необходимую поддержку...
                                </div>
                                <div class="stock__item-btn">
                                    <a href="#">подробнее</a>
                                </div>
                            </div>
                        </div>
                        <div class="stock__item">
                            <div class="stock__item-img">
                                <img src="{{asset('assets/frontend/images/content/stock.png')}}" alt="">
                            </div>
                            <div class="stock__item-content">
                                <div class="stock__item-title">
                                    Супер цена! Длинный заголовок, возможно на две строки
                                </div>
                                <div class="stock__item-info">
                                    <span class="icon-time icon"></span> Акция действует c 01.11.2019 по 31.12.2019
                                </div>
                                <div class="stock__item-text">
                                    Все мы с Вами слышали о существовании такой замечательной вещи, как принтер. Он
                                    обеспечивает нам необходимую поддержку...
                                </div>
                                <div class="stock__item-btn">
                                    <a href="#">подробнее</a>
                                </div>
                            </div>
                        </div>
                        <div class="stock__item">
                            <div class="stock__item-img">
                                <img src="{{asset('assets/frontend/images/content/stock.png')}}" alt="">
                            </div>
                            <div class="stock__item-content">
                                <div class="stock__item-title">
                                    Супер цена! Длинный заголовок, возможно на две строки
                                </div>
                                <div class="stock__item-info">
                                    <span class="icon-time icon"></span> Акция действует c 01.11.2019 по 31.12.2019
                                </div>
                                <div class="stock__item-text">
                                    Все мы с Вами слышали о существовании такой замечательной вещи, как принтер. Он
                                    обеспечивает нам необходимую поддержку...
                                </div>
                                <div class="stock__item-btn">
                                    <a href="#">подробнее</a>
                                </div>
                            </div>
                        </div>
                        <div class="stock__items-btn">
                            <a href="#"><span class="icon icon-rotate"></span> Показать ещё</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection