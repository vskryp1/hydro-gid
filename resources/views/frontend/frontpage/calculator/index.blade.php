@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/calculator.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="calculator page--line">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="page__title">
                <div class="container">
                    Калькуляторы
                </div>
            </div>
            <div class="calculator__items">
                <a href="#" class="calculator__item">
                    <div class="calculator__img">
                        <img src="{{asset('assets/frontend/images/calc/item-1.png')}}" alt="">
                    </div>
                    <div class="calculator__text">
                        Калькулятор подбора гидроцилиндров
                    </div>
                </a>
                <a href="#" class="calculator__item">
                    <div class="calculator__img">
                        <img src="{{asset('assets/frontend/images/calc/item-2.png')}}" alt="">
                    </div>
                    <div class="calculator__text">
                        Калькулятор подбора гидравлических станций
                    </div>
                </a>
                <a href="#" class="calculator__item">
                    <div class="calculator__img">
                        <img src="{{asset('assets/frontend/images/calc/item-3.png')}}" alt="">
                    </div>
                    <div class="calculator__text">
                        Калькулятор расчета простейшего гидропривода
                    </div>
                </a>
            </div>
        </div>
    </main>
@endsection