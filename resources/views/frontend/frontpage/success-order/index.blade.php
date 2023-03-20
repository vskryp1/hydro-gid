@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/success-order.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="success-order">
            <div class="success-order__inner">
                {!! Html::image('/assets/frontend/images/basket-images.png') !!}
                <div class="success-order__title">
                    Ваш заказ оформлен!
                </div>
                <div class="success-order__number">
                    Номер вашего заказа: <span>#234324234</span>
                </div>
                <div class="success-order__text">
                    В ближайшее время к вам придет письмо с деталями
                </div>
                <a class="success-order__link" href="#">Продолжить покупки</a>
            </div>
        </div>
    </main>
@endsection