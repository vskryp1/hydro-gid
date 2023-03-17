@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/questions.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="questions">
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
                    Вопросы и ответы
                </div>
            </div>
            <div class="container">
                <div class="questions__inner">
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
                    </div>
                    <div class="questions__item">
                        Можно ли внести изменения в сделанный заказ?
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="questions__item-answer">
                        После того, как заказ сделан, в него нельзя внести изменения, например, поменять размер, цвет
                        или добавить новый товар. После того, как заказ сделан, в него нельзя внести изменения,
                        например, поменять размер, цвет или добавить новый товар. После того, как заказ сделан, в него
                        нельзя внести изменения, например, поменять размер, цвет или добавить новый товар
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
                                <div class="input-container input-container__file">
                                    <div class="icon icon-clip"></div>
                                    <label for="files1">прикрепите файл</label>
                                    <input id="files1" accept="application/pdf,text/plain,application/msword,application/rtf,application/x-rtf,text/richtext,application/rtf,text/richtext,application/vnd.oasis.opendocument.text" type="file" name="myResume" data-error-type="Неверный тип файла" data-error-size="Недопустимый размер файла" data-error-existence="Файл не выбран. Загрузите файл" required="required" class="files">
                                    <div class="delete"></div>
                                    <div class="text-error">Загрузите файл</div>
                                </div>
                                <div class="input-container__file-desckt"><span>Размер файла не должен превышать 5 мб</span><span>Разрешены следующие форматы: .pdf, .txt, .doc, .docx, .rtf, .odt</span></div>
                            </div>
                        </div>
                        <button>Задать вопрос</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection