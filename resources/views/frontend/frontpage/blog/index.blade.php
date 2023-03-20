@extends('frontend.layout')

@section('styles')
    @parent

    {!! Html::style(mix('/assets/frontend/css/blog.min.css')) !!}
@endsection

@section('scripts')
    @parent

    {!! Html::script(mix('/assets/frontend/js/main.js')) !!}
@endsection

@section('content')
    <main>
        <div class="blog">
            <div class="container">
                <div class="breadcrumb">
                    <ul class="breadcrumb-list">
                        <li><a href="#"><i class="icon icon-home"></i></a></li>
                        <li><a href="#">Гидравлические клапана</a></li>
                        <li class="active"><span>Гидромоторы шестерные</span></li>
                    </ul>
                </div>
            </div>
            <div class="blog__title page--line">
                <div class="container">
                    Блог
                </div>
                <div class="sort-holder">
                    <select name="" class="sort-select" data-placeholder="Популярность">
                        <option value="-1">Выберете категорию</option>
                        <option value="0">Популярность</option>
                        <option value="1">Цена</option>
                    </select>
                </div>
            </div>
            <div class="container">
                <div class="blog__items row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="blog__item">
                        <a href="#">
                            <div class="blog__item-img">
                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                            </div>
                            <div class="blog__item-title">
                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                            </div>
                            <div class="blog__item-date">
                                <span class="icon icon-calendar"></span> 27 октября 2019
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="blog__item">
                        <a href="#">
                            <div class="blog__item-img">
                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                            </div>
                            <div class="blog__item-title">
                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                            </div>
                            <div class="blog__item-date">
                                <span class="icon icon-calendar"></span> 27 октября 2019
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="blog__item">
                        <a href="#">
                            <div class="blog__item-img">
                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                            </div>
                            <div class="blog__item-title">
                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                            </div>
                            <div class="blog__item-date">
                                <span class="icon icon-calendar"></span> 27 октября 2019
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="blog__item">
                        <a href="#">
                            <div class="blog__item-img">
                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                            </div>
                            <div class="blog__item-title">
                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                            </div>
                            <div class="blog__item-date">
                                <span class="icon icon-calendar"></span> 27 октября 2019
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="blog__item">
                        <a href="#">
                            <div class="blog__item-img">
                                <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                            </div>
                            <div class="blog__item-title">
                                ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                            </div>
                            <div class="blog__item-date">
                                <span class="icon icon-calendar"></span> 27 октября 2019
                            </div>
                        </a>
                    </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="blog__item">
                            <a href="#">
                                <div class="blog__item-img">
                                    <img src="{{asset('/assets/frontend/images/content/blog.jpg')}}" alt="">
                                </div>
                                <div class="blog__item-title">
                                    ООО «Грайф Флексиблс Украина» успешно прошло сертификацию по новой версии Стандарта ISO 9001.
                                </div>
                                <div class="blog__item-date">
                                    <span class="icon icon-calendar"></span> 27 октября 2019
                                </div>
                            </a>
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
        </div>
    </main>
@endsection