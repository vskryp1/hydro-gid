@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/about.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="about">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="page--line">
                <div class="container">
                    <div class="about__head">
                        <div class="about__title">
                            Лидерство говорит само за себя!
                        </div>
                        <div class="about__logo">
                            <img src="{{asset('/assets/frontend/images/logo@2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="about__content">
                <div class="about__text">
                    ООО «ГИДРО – ГИД» - комплексный поставщик системных решений и комплектующих на рынке гидравлического оборудования. Сотрудничая с нашей компанией Вы получите: многолетний опыт работы команды профессионалов, системный подход, подбор и реализацию наиболее оптимальных решений в кратчайший срок. Для решения Ваших задач в структуре нашей компании функционируют: конструкторское бюро, отдел продаж, современные цеха по изготовлению маслостанций и миниагрегатов, насосно-моторных групп, ремонту и производству гидроцилиндров и опресовке рукавов высокого давления, которые оснащены по последнему слову техники, что позволяет выпускать высококачественную продукцию
                </div>

                    <div class="about__content-images"></div>
                    <div class="about__content-box">
                    <div class="about__content-title">
                        Поставщик гидравлического оборудования №1
                    </div>
                    <div class="about__content-text">
                        <p>
                            Среди основных партнеров нашей компании можно выделить ведущих европейских и американских производителей гидравлики, среди которых: Sauer Danffos, Bosch Rexroth, Badestnost, Internormen, OMT, M+S Hydraulic, Metaris, Vickers, Italgroup, Atos, Eaton, Casappa, Aber, Brevini, Marchesini, Caproni,
                        </p>
                        <p>
                            Parker, Hydac, Salami, B&C, Berarma, Sanfub, Bieri, Bucher, Duplomatic, Epoll, Luen, Ponar, Sai, Simrit, Walwoil, Seim и другие компании, с которыми у ООО «ГИДРО-ГИД» налажены тесные партнерский отношения. Таким образом, поставки компонентов гидравлики от ведущих мировых производителей, высокотехнологическое производство, наличие сервисной службы и собственной лаборатории для диагностики и испытаний, делают нашу компанию безоговорочным лидером на рынке гидравлического оборудования не только в Украине, но и в других странах Восточной Европы
                        </p>
                    </div>
                </div>
            </div>
            <div class="benefits">
                <div class="benefits__gradient"></div>
                <div class="container">
                    <div class="benefits__title">Преимущества</div>
                    <div class="benefits__items">
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-1.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Выгодно</div>
                            <div class="benefits__item-text">
                                Оборудование по цене
                                производителя
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-2.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Быстро</div>
                            <div class="benefits__item-text">
                                Отправка товара
                                по Украине
                                в день заказа
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-3.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Надежно</div>
                            <div class="benefits__item-text">
                                Только оригинальная продукция проверенных брендов
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-4.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Профессионально</div>
                            <div class="benefits__item-text">
                                Более 12 лет
                                опыта работы
                                с гидравлическим оборудованием
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="partners">
                <div class="container">
                    <div class="pertners__title">
                        Наши партнеры
                    </div>
                    <div class="partners__items">
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/2.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/3.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                            <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>
                        <div class="partners__items-img">
                        <img src="{{asset('assets/frontend/images/partners/1.png') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
            <div class="about__gallery">
                <div class="container">
                <div class="about__gallery-inner">
                    <a href="{{asset('/assets/frontend/images/content/about/image-1.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-1.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>

                    <a href="{{asset('/assets/frontend/images/content/about/image-3.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-3.jpg') }}" />
                    </a>
                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>
                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>
                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>
                    <a href="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" data-fancybox="images">
                        <img src="{{asset('/assets/frontend/images/content/about/image-2.jpg') }}" />
                    </a>
                </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection