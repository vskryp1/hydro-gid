<?php

    Route::post('liqpay_feedback', 'Frontend\CheckoutController@liqpay')->name('liqpay_feedback');
    Route::get('paypal_feedback', 'Frontend\CheckoutController@paypal')->name('paypal_feedback');
