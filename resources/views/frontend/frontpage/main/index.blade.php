@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/main.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main class="main">
        <div class="top">
            <div class="container">
                <div class="top__inner">
                    <div class="top__slider">
                        <div class="top__slider-item">
                            <div class="top__slider-content">
                                <div class="top__slider-info">
                                    <div class="top__slider-pretitle">
                                        BADESTNOST
                                    </div>
                                    <div class="top__slider-title">
                                        <span>CПЕЦИАЛЬНОЕ</span>
                                        ПРЕДЛОЖЕНИЕ
                                    </div>
                                    <div class="top__slider-text">
                                        На всю линейку гидрораспределителей
                                    </div>
                                    <div class="top__slider-link">
                                        <a href="#">подробнее</a>
                                    </div>
                                </div>
                                <div class="top__slider-images">
                                    <img src="{{asset('assets/frontend/images/banner-slider.png') }}" alt="#"/>
                                </div>
                            </div>
                        </div>
                        <div class="top__slider-item">
                            <div class="top__slider-content">
                                <div class="top__slider-info">
                                    <div class="top__slider-pretitle">
                                        BADESTNOST
                                    </div>
                                    <div class="top__slider-title">
                                        <span>CПЕЦИАЛЬНОЕ</span>
                                        ПРЕДЛОЖЕНИЕ
                                    </div>
                                    <div class="top__slider-text">
                                        На всю линейку гидрораспределителей
                                    </div>
                                    <div class="top__slider-link">
                                        <a href="#">подробнее</a>
                                    </div>
                                </div>
                                <div class="top__slider-images">
                                    <img src="{{asset('assets/frontend/images/banner-slider.png') }}" alt="#"/>
                                </div>
                            </div>
                        </div>
                        <div class="top__slider-item">
                            <div class="top__slider-content">
                                <div class="top__slider-info">
                                    <div class="top__slider-pretitle">
                                        BADESTNOST
                                    </div>
                                    <div class="top__slider-title">
                                        <span>CПЕЦИАЛЬНОЕ</span>
                                        ПРЕДЛОЖЕНИЕ
                                    </div>
                                    <div class="top__slider-text">
                                        На всю линейку гидрораспределителей
                                    </div>
                                    <div class="top__slider-link">
                                        <a href="#">подробнее</a>
                                    </div>
                                </div>
                                <div class="top__slider-images">
                                    <img src="{{asset('assets/frontend/images/banner-slider.png') }}" alt="#"/>
                                </div>
                            </div>
                        </div>
                        <div class="top__slider-item">
                            <div class="top__slider-content">
                                <div class="top__slider-info">
                                    <div class="top__slider-pretitle">
                                        BADESTNOST
                                    </div>
                                    <div class="top__slider-title">
                                        <span>CПЕЦИАЛЬНОЕ</span>
                                        ПРЕДЛОЖЕНИЕ
                                    </div>
                                    <div class="top__slider-text">
                                        На всю линейку гидрораспределителей
                                    </div>
                                    <div class="top__slider-link">
                                        <a href="#">подробнее</a>
                                    </div>
                                </div>
                                <div class="top__slider-images">
                                    <img src="{{asset('assets/frontend/images/banner-slider.png') }}" alt="#"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top__banners">
                        <div class="dropdown__banner-item">
                            <div class="banner__info">
                                <div class="banner__pretitle">Гидрораспределители</div>
                                <div class="banner__title">MOZIONI</div>
                                <div class="banner__text">По самым выгодным ценам</div>
                                <a href="#" class="banner__link">подробнее</a>
                            </div>
                            <div class="banner__images">
                                <img src="{{asset('assets/frontend/images/banner.png') }}" alt="#"/>
                            </div>
                        </div>
                        <div class="dropdown__banner-item">
                            <div class="banner__info">
                                <div class="banner__pretitle">Гидрораспределители</div>
                                <div class="banner__title">MOZIONI</div>
                                <div class="banner__text">По самым выгодным ценам</div>
                                <a href="#" class="banner__link">подробнее</a>
                            </div>
                            <div class="banner__images">
                                <img src="{{asset('assets/frontend/images/banner.png') }}" alt="#"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="container">
                <div class="products__title">
                    Продукция
                </div>
                <div class="product--bg"></div>
                <div class="products__items">
                    <div class="products__item">
                        <div class="products__item--hover"></div>
                        <div class="products__item-inner">
                            <img src="{{asset('assets/frontend/images/products-1.png') }}" alt="#"/>
                            <div class="products__item-title">
                                Гидрораспределители
                                с электромагнитным управлением
                            </div>
                        </div>
                    </div>
                    <div class="products__item">
                        <div class="products__item--hover"></div>
                        <div class="products__item-inner">
                            <img src="{{asset('assets/frontend/images/products-2.png') }}" alt="#"/>
                            <div class="products__item-title">
                                Гидрораспределители
                            </div>
                        </div>
                    </div>
                    <div class="products__item">
                        <div class="products__item--hover"></div>
                        <div class="products__item-inner">
                            <img src="{{asset('assets/frontend/images/products-3.png') }}" alt="#"/>
                            <div class="products__item-title">
                                Гидромоторы
                            </div>
                        </div>
                    </div>
                    <div class="products__item">
                        <div class="products__item--hover"></div>
                        <div class="products__item-inner">
                            <img src="{{asset('assets/frontend/images/products-4.png') }}" alt="#"/>
                            <div class="products__item-title">
                                Гидравлические краны
                            </div>
                        </div>
                    </div>
                </div>
                <div class="products__list-wrapper">
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-1.png') }}" alt="#"/>
                        <div class="products__list-text">Гидравлические краны</div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-2.png') }}" alt="#"/>
                        <div class="products__list-text">Теплообменники
                            (Маслоохладители)
                        </div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-3.png') }}" alt="#"/>
                        <div class="products__list-text">Реле давления</div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-4.png') }}" alt="#"/>
                        <div class="products__list-text">Гидравлические клапаны</div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-5.png') }}" alt="#"/>
                        <div class="products__list-text">Аксессуары для маслостанций</div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-6.png') }}" alt="#"/>
                        <div class="products__list-text">Аксессуары для маслостанций</div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-7.png') }}" alt="#"/>
                        <div class="products__list-text">Гидравлические
                            насосы
                        </div>
                    </div>
                    <div class="products__list">
                        <div class="products__item--hover"></div>
                        <img src="{{asset('assets/frontend/images/products-list-8.png') }}" alt="#"/>
                        <div class="products__list-text">Гидравлические краны</div>
                    </div>
                </div>
                <div class="services__title">
                    Услуги
                </div>
                <div class="services__items">
                    <div class="services__item">
                        <div class="services__item-inner"
                             style="background-image: url(assets/frontend/images/serv-1.jpg);">
                            <div class="services__item--hover"></div>
                            <div class="services__item-text">
                                Изготовление <br>
                                и сервисное обслуживание маслостанций
                            </div>
                            <div class="services__line"></div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__item-inner"
                             style="background-image: url(assets/frontend/images/serv-2.jpg);">
                            <div class="services__item--hover"></div>
                            <div class="services__item-text">
                                Производство
                                и ремонт гидроцилиндров
                            </div>
                            <div class="services__line"></div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__item-inner"
                             style="background-image: url(assets/frontend/images/serv-3.jpg);">
                            <div class="services__item--hover"></div>
                            <div class="services__item-text">
                                Изготовление маслостанций
                                для прессов
                            </div>
                            <div class="services__line"></div>
                        </div>
                    </div>
                    <div class="services__item">
                        <div class="services__item-inner"
                             style="background-image: url(assets/frontend/images/serv-4.jpg);">
                            <div class="services__item--hover"></div>
                            <div class="services__item-text">
                                Маслостанции <br>
                                для тралла <br>
                                и гидроборта 12/24 В
                            </div>
                            <div class="services__line"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="benefits">
            <div class="benefits__gradient"></div>
            <div class="container">
                <div class="benefits__title">Преимущества</div>
                <div class="benefits__items">
                    <div class="benefits__item-inner">
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-1.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Выгодно</div>
                            <div class="benefits__item-text">
                                Оборудование по цене
                                производителя
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                    </div>
                    <div class="benefits__item-inner">
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
                    </div>
                    <div class="benefits__item-inner">
                        <div class="benefits__item">
                            <img src="{{asset('assets/frontend/images/benefits-3.svg') }}" alt="#"/>
                            <div class="benefits__item-title">Надежно</div>
                            <div class="benefits__item-text">
                                Только оригинальная продукция проверенных брендов
                            </div>
                            <div class="benefits__line"></div>
                        </div>
                    </div>
                    <div class="benefits__item-inner">
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
        </div>
        <div class="seo">
            <div class="container">
                <div class="seo__title">
                    Заголовок СЕО
                </div>
                <div class="sep__text-wrapper">
                    <div class="seo__text">
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                        Далеко-далеко за словесными горами в стране гласных и согласных живут рыбные тексты.
                        Необходимыми рукопись
                        журчит грамматики, парадигматическая безорфографичный не снова залетают, маленький силуэт
                        ведущими свой его
                        жизни своих щеке раз великий океана!
                        Они букв обеспечивает толку языком переулка инициал жизни рукописи если запятых? Буквенных даже
                        наш,
                        переписывается речью необходимыми коварный коварных, что обеспечивает повстречался, буквоград
                        раз своего
                        дорогу вдали единственное своих несколько.
                        Дорогу языкового над великий маленькая предупредила диких, повстречался пояс злых власти
                        строчка, предложения
                        своих не послушавшись снова пустился парадигматическая? Злых своих свой безорфографичный
                        маленький рукопись,
                        дороге приставка сбить это города.
                        Города, запятых дороге! Возвращайся над, собрал от всех, которое ipsum lorem ведущими коварных
                        буквоград пояс
                        бросил оксмокс лучше пунктуация речью рукописи моей обеспечивает! Заманивший единственное
                        необходимыми
                        буквенных но на берегу несколько повстречался?
                        Дороге она, lorem себя, приставка первую, грустный имеет вскоре алфавит продолжил возвращайся
                        если залетают.
                        Строчка, встретил текстов там родного, маленький за буквоград безопасную, своих жизни власти
                        lorem семантика
                        свое осталось!
                        Предупредила на берегу города, страну грустный своих первую коварных алфавит, великий
                        предложения взобравшись
                        журчит сбить не имеет рот, продолжил напоивший злых вдали проектах запятых правилами дорогу
                        инициал жизни.
                        Осталось, однажды себя?
                        Если реторический вершину переписывается от всех вдали сбить взгляд, проектах свой взобравшись
                        большой ее но
                        своего образ дороге океана. Даже ее повстречался языком алфавит проектах всеми великий меня
                        грамматики
                        пунктуация снова?
                        Великий взгляд вершину встретил рекламных всемогущая большого, буквенных семантика заманивший о
                        родного злых
                        если несколько, букв дал? Рукописи запятой коварных путь. Имени, подпоясал продолжил! Себя меня
                        языкового
                        снова лучше мир.
                        Реторический предупреждал вскоре обеспечивает всемогущая заманивший за лучше деревни курсивных,
                        парадигматическая грустный буквоград ему, возвращайся если. Последний заманивший ты что щеке
                        имени решила там,
                        свое ее проектах, послушавшись моей? Злых!
                        Коварных, буквоград. Инициал семантика мир снова безорфографичный однажды коварный он выйти
                        языкового, пояс
                        своих переписали залетают живет толку реторический вершину даль ipsum всемогущая себя назад злых
                        домах.
                        Пустился, по всей. Курсивных?
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection