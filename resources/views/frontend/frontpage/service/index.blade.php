@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/service.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="page--line">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="service__inner">
            <div class="container">
                <div class="service__item">
                    <div class="service__title">
                        Супер цена! Длинный заголовок, возможно на две строки
                    </div>
                    <div class="service__item-content">
                        <div class="service__item-img">
                            <img src="{{asset('assets/frontend/images/service.jpg')}}" alt="">
                        </div>
                        <div class="service__item-text">
                            Таким образом консультация с широким активом позволяет выполнять важные задания по
                            разработке дальнейших направлений развития. Не следует, однако забывать, что дальнейшее
                            развитие различных форм деятельности требуют определения и уточнения существенных финансовых
                            и административных условий. Не следует, однако забывать, что постоянное
                            информационно-пропагандистское обеспечение нашей деятельности в значительной степени
                            обуславливает создание модели развития. Повседневная практика показывает, что рамки и место
                            обучения кадров требуют от нас анализа новых предложений. С другой стороны постоянное
                            <div class="service__item-btn">
                                <a href="#">заказать услугу</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="service__title-advantage">
                    Почему заказать маслостанцию у нас выгодно?
                </div>
                <div class="service__advantage-inner">
                    <div class="service__advantage-item">
                        <div class="service__advantage-img">
                            <img src="{{asset('/assets/frontend/images/service/item-1.svg')}}" alt="">
                        </div>
                        <div class="service__advantage-textbox">
                            <div class="service__advantage-title">
                                Никаких переплат
                            </div>
                            <div class="service__advantage-text">
                                Мы работаем без посредников, поэтому можем предложить оптимальные цены на свои услуги,
                                без искусственных накруток. Налаженные постоянные оптовые закупки комплектующих
                                позволяют нам предельно снизить стоимость маслостанций
                            </div>
                        </div>
                    </div>
                    <div class="service__advantage-item">
                        <div class="service__advantage-img">
                            <img src="{{asset('/assets/frontend/images/service/item-2.svg')}}" alt="">
                        </div>
                        <div class="service__advantage-textbox">
                            <div class="service__advantage-title">
                                Гарантийное и послегарантийное обслуживание
                            </div>
                            <div class="service__advantage-text">
                                Мы работаем без посредников, поэтому можем предложить оптимальные цены на свои услуги,
                                без искусственных накруток. Налаженные постоянные оптовые закупки комплектующих
                                позволяют нам предельно снизить стоимость маслостанций
                            </div>
                        </div>
                    </div>
                    <div class="service__advantage-item">
                        <div class="service__advantage-img">
                            <img src="{{asset('/assets/frontend/images/service/item-3.svg')}}" alt="">
                        </div>
                        <div class="service__advantage-textbox">
                            <div class="service__advantage-title">
                                Профессионализм
                            </div>
                            <div class="service__advantage-text">
                                Мы работаем без посредников, поэтому можем предложить оптимальные цены на свои услуги,
                                без искусственных накруток. Налаженные постоянные оптовые закупки комплектующих
                                позволяют нам предельно снизить стоимость маслостанций
                            </div>
                        </div>
                    </div>
                    <div class="service__advantage-item">
                        <div class="service__advantage-img">
                            <img src="{{asset('/assets/frontend/images/service/item-4.svg')}}" alt="">
                        </div>
                        <div class="service__advantage-textbox">
                            <div class="service__advantage-title">
                                Оперативность
                            </div>
                            <div class="service__advantage-text">
                                Мы работаем без посредников, поэтому можем предложить оптимальные цены на свои услуги,
                                без искусственных накруток. Налаженные постоянные оптовые закупки комплектующих
                                позволяют нам предельно снизить стоимость маслостанций
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stages">
                    <div class="stages__title">
                        Этапы
                    </div>
                    <div class="stages__line"></div>
                    <div class="stages__items">
                        <div class="stages__item">
                            <div class="stages__item-number">1</div>
                            <div class="stages__item-text">
                                Заключение договора, получение полной или частичной предоплаты
                            </div>
                        </div>
                        <div class="stages__item">
                            <div class="stages__item-number">2</div>
                            <div class="stages__item-text">
                                Разработка технической документации и согласование ее с заказчиком
                            </div>
                        </div>
                        <div class="stages__item">
                            <div class="stages__item-number">3</div>
                            <div class="stages__item-text">
                                Запуск в производство
                            </div>
                        </div>
                        <div class="stages__item">
                            <div class="stages__item-number">4</div>
                            <div class="stages__item-text">
                                Испытание готовой гидростанции
                            </div>
                        </div>
                        <div class="stages__item">
                            <div class="stages__item-number">5</div>
                            <div class="stages__item-text">
                                Поставка готовой станции любым удобным способом
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom__form">
                    <div class="bottom__form-title">
                        Закажите услугу
                    </div>
                    <form>
                        <div class="column-row">
                            <div class="column">
                                <input type="text" placeholder="Имя*" required>
                                <input type="text" placeholder="Email*" required>
                                <input type="text" placeholder="Телефон*" required>
                            </div>
                            <div class="column">
                                <textarea placeholder="Напишите ваш комментарий..."></textarea>
                            </div>
                        </div>
                        <button>заказать</button>
                    </form>
                </div>


            </div>
        </div>
    </main>
@endsection