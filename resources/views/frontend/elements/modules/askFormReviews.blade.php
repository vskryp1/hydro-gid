<div class="ask-form__wrapp">
    <div class="container">
        <div class="page-title page-title--white">Задайте нам вопросы</div>
        <div class="ask-form__box flex-wrap middle-xs">
            <div class="ask-form__form">
                <form role="form" method="post" class="js_validate" action="#">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-field input-field" data-error="Обязательное поле">
                                <span class="label">Имя</span>
                                <input name="#" class="validate" type="text" required="">
                            </div>
                            <div class="form-field input-field" data-error="Обязательное поле">
                                <span class="label">Email</span>
                                <input name="#" class="validate" type="email" required="" data-validate="email">
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-field input-field row_input" data-error="Обязательное поле">
                                <span class="label">Текст</span>
                                <textarea name="#" class="validate" required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="rating-step">
                        <span>Оценка</span>
                        <div data-mark="0"
                             data-star-on="{{asset('assets/frontend/images/elements/on.png') }}"
                             data-star-off="{{asset('assets/frontend/images/elements/off.png') }}"
                             class="star js_review">
                        </div>
                    </div>

                    <div class="flex-wrap two-col">
                        <div class="column">
                            <button type="submit" class="button-reset main-btn main-btn--dark-blue submit">Отправить</button>
                        </div>
                        <div class="box-inputFile column">
                            <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected">
                            <label for="file-2"><i class="icon icon-shopping-cart"></i><span>Добавить фото.</span></label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="ask-form__img">
                <img src="{{asset('assets/frontend/images/elements/message.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>