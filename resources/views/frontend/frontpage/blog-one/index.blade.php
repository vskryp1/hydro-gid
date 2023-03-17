@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/blog-one.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="blog blog-one__page">
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
            <div class="container">
                <div class="blog-one__inner">
                    <div class="blog-one__content article">
                        <div class="article__title">
                            ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001
                        </div>
                        <div class="article__info">
                            <div class="article__date">
                                <i class="icon icon-calendar"></i>
                                27 октября 2019</div>
                            <div class="article__social">
                                Поделиться в соцсетях: <a href="#"><i class="icon icon-fb"></i></a> <a href="#"><i class="icon icon-linkedin"></i></a>
                            </div>
                        </div>
                            <img src="{{asset('/assets/frontend/images/content/blog-one.jpg')}}" alt="">
                            <p>
                                Равным образом дальнейшее развитие различных форм деятельности требуют определения и уточнения направлений прогрессивного развития. Равным образом новая модель организационной деятельности влечет за собой процесс внедрения и модернизации систем массового участия. Значимость этих проблем настолько очевидна, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют от нас анализа новых предложений.
                            </p>
                            <p>
                                Значимость этих проблем настолько очевидна, что рамки и место обучения кадров обеспечивает широкому кругу (специалистов) участие в формировании модели развития. Повседневная практика показывает, что постоянное информационно-пропагандистское обеспечение нашей деятельности требуют определения и уточнения дальнейших направлений развития. Не следует, однако забывать, что постоянный количественный рост и сфера нашей активности требуют определения и уточнения модели развития. Идейные соображения высшего порядка, а также новая модель организационной деятельности влечет за собой процесс внедрения и модернизации системы обучения кадров, соответствует насущным потребностям. Идейные соображения высшего порядка, а также реализация намеченных плановых заданий позволяет оценить значение существенных финансовых и административных условий. Разнообразный и богатый опыт дальнейшее развитие различных форм деятельности требуют определения и уточнения соответствующий условий активизации.
                            </p>
                        <img src="{{asset('/assets/frontend/images/content/blog-one.jpg')}}" alt="">
                        <div class="article__info">
                            <div class="article__date">
                                <i class="icon icon-calendar"></i>
                                27 октября 2019</div>
                            <div class="article__social">
                                Поделиться в соцсетях: <a href="#"><i class="icon icon-fb"></i></a> <a href="#"><i class="icon icon-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-one__aside">
                        <div class="blog-one__aside-checkout">
                        <div class="checkout__aside-title">
                            Используемые в статье товары:
                        </div>
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img" src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)</div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img" src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)</div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout__aside-item">
                            <img class="checkout__aside-img" src="{{asset('/assets/frontend/images/content/content-item.png')}}" alt="">
                            <div class="checkout__aside-info">
                                <div class="checkout__aside-text">Регулятор расхода 3х линейный со сбросом в бак RFP3 3/8" (Италия)</div>
                                <div class="checkout__aside-number">
                                    <div class="checkout__aside-prise">
                                        800 550 <span>грн</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="latest-publications">
                            <div class="latest-publications__title">
                                Последние публикации:
                            </div>
                            <div class="latest-publications__item">
                                <div class="latest-publications__date">
                                    <i class="icon icon-calendar"></i>
                                    27 октября 2019
                                </div>
                                <div class="latest-publications__text">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001
                                </div>
                            </div>
                            <div class="latest-publications__item">
                                <div class="latest-publications__date">
                                    <i class="icon icon-calendar"></i>
                                    27 октября 2019
                                </div>
                                <div class="latest-publications__text">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001
                                </div>
                            </div>
                            <div class="latest-publications__item">
                                <div class="latest-publications__date">
                                    <i class="icon icon-calendar"></i>
                                    27 октября 2019
                                </div>
                                <div class="latest-publications__text">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001
                                </div>
                            </div>
                        </div>
                        <div class="blog-one__form">
                            <div class="blog-one__form-title">
                                Подпишитесь на рассылку
                            </div>
                            <label>
                                <input type="text" placeholder="Ваш E-mail*" required>
                                <i class="icon icon-union"></i>
                            </label>
                            <button type="submit">подписаться</button>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </main>
@endsection