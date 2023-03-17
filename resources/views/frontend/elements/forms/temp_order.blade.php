<div id="modal-buy_per_click">
    <div class="modal__inner">
        <div class="modal__title">
            @lang('frontend/service/index.we_will_call_you')
        </div>
        <div class="modal__content">
            {!! Form::open([
              'route'  => 'frontend.forms.buy_per_click',
              'method' => 'POST',
              'files'  => true,
              'id'     => 'buy_per_click-form',
              'class'  => 'login__form modal__form'
            ]) !!}
            <label>
                {!! Form::text('phone', auth('web')->check() ? auth('web')->user()->phone : null, [
                     'placeholder' => __('frontend/service/index.phone'),
                ]) !!}
                {!! Form::text('name', auth('web')->check() ? auth('web')->user()->name : null, [
                     'placeholder' => __('frontend/service/index.username'),
                ]) !!}
            </label>
            {!! Form::button(__('frontend/content/index.buy_per_click'), [ 'type' => 'submit', 'class' => 'main-btn main-btn--green main-btn--center' ]) !!}
            {!! Form::hidden('product_id',$product->id) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\Frontend\ServiceOrder\BuyPerClickRequest', '#buy_per_click-form') !!}
@endsection
