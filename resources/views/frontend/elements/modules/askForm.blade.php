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
                                <textarea name="#" type="text" class="validate" required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button-reset main-btn main-btn--dark-blue submit">Отправить</button>
                </form>
            </div>
            <div class="ask-form__img">
                <img src="{{asset('assets/frontend/images/elements/message.svg') }}" alt="">
            </div>
        </div>
    </div>
</div>