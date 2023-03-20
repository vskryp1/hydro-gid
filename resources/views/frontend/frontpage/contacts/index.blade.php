@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/contacts.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="certificates">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="page__title page--line">
                <div class="container">
                    Контакты
                </div>
            </div>
            <div class="container">
                <div class="contacts__inner">
                    <div class="contacts__info">
                        <div class="contacts__title">
                            ООО “Гидро - Гид”
                        </div>
                        <div class="contacts__title-sup">
                            Наш адрес:
                        </div>
                        <div class="contacts__text">
                            г. Харьков, ул. Шевченко, 15
                        </div>
                        <div class="contacts__title-sup">
                            График работы
                        </div>
                        <div class="contacts__text">
                            <div class="contacts__text-line">
                                <div class="contacts__day">Пн-Пт:</div>
                                <div class="contacts__time">9:00 - 19:00</div>
                            </div>
                            <div class="contacts__text-line">
                                <div class="contacts__day">Суббота:</div>
                                <div class="contacts__time">10:00 - 17:00</div>
                            </div>
                            <div class="contacts__text-line">
                                <div class="contacts__day">Воскресение:</div>
                                <div class="contacts__time">Выходной</div>
                            </div>
                        </div>
                        <div class="contacts__title-sup">
                            Телефоны:
                        </div>
                        <a class="contacts__phone" href="tel:+380441234452">+38 (044) 123 44 52</a>
                        <a class="contacts__phone" href="tel:+380509421553">+38 (050) 942 15 53</a>
                        <a class="contacts__phone" href="tel:+380678531042">+38 (067) 853 10 42</a>
                        <div class="contacts__social">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/facebook.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/instagram.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/linkedin.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/telegram.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/skype.svg')}}" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="{{asset('/assets/frontend/images/social/viber.svg')}}" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="contacts__form">
                        <form>
                            <div class="contacts__form-title">
                                Обратная связь
                            </div>
                            <div class="contacts__form-line">
                                <div class="contacts__form-phone">
                                    <input type="tel" placeholder="Ваш телефон*">
                                </div>
                                <div class="contacts__form-check">
                                    <div class="filter__items checkbox">
                                        <div class="filter-area">
                                            <input type="checkbox" name="fltr-1" id="fltr-1">
                                            <label for="fltr-1">Перезвоните мне</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="contacts__form-line">
                                <div class="contacts__form-name">
                                    <input type="text" placeholder="Ваше имя*">
                                </div>
                                <div class="contacts__form-mail">
                                    <input type="text" placeholder="Ваш E-mail">
                                </div>
                            </div>
                            <textarea placeholder="Напишите ваше сообщение ..."></textarea>
                            <div class="input-container input-container__file">
                                <div class="icon icon-clip"></div>
                                <label for="files1">прикрепите файл</label>
                                <input id="files1" accept="application/pdf,text/plain,application/msword,application/rtf,application/x-rtf,text/richtext,application/rtf,text/richtext,application/vnd.oasis.opendocument.text" type="file" name="myResume" data-error-type="Неверный тип файла" data-error-size="Недопустимый размер файла" data-error-existence="Файл не выбран. Загрузите файл" required="required" class="files">
                                <div class="delete"></div>
                                <div class="text-error">Загрузите файл</div>
                            </div>
                            <div class="input-container__file-desckt"><span>Размер файла не должен превышать 5 мб</span><span>Разрешены следующие форматы: .pdf, .txt, .doc, .docx, .rtf, .odt</span></div>
                            <button>перезвоните мне</button>
                        </form>
                    </div>

                </div>
            </div>
            <section class="contacts__maps">
                <div id="map" data-coords="50.423411, 30.538572"></div>
            </section>
        </div>
    </main>
@endsection