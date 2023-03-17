<div class="js-delivery-type checkout__radio-box {{ $class }}">
    <div class="checkout__radio-title">
        {{ $delivery->name }}
    </div>
    @isset($addresses)
        @foreach($addresses as $address)
            <label class="radio">
                <input class="js-delivery-address AddressRadio"
                       @if($loop->first) checked @endif
                       name="address_id"
                       data-id="{{ $address->id }}"
                       value="{{ $address->id  }}"
                       type="radio">
                <span>{{ $address->formatted }}</span>
            </label>
        @endforeach
    @endisset
    @if(auth('web')->user())
        <label class="radio">
            <input class="js-delivery-address newAddressRadio"
                   name="address_id"
                   value=""
                   type="radio">
            <span>@lang('frontend/checkout/index.new_address')</span>
        </label>
    @endif
    <div class="delivery_address" @if($addresses->isNotEmpty()) style="display: none" @endif>
        <div class="form-group">
            {{ Form::select(
                'place_api_id',
                [],
                 null,
                [
                    'class'     => 'delivery-select form-control',
                    'id'        => 'delivery_place_id',
                ])
            }}
        </div>
        <div class="form-group">
            {{ Form::label(__('frontend/profile/index.street')) }}
            {{ Form::text('street', null,
             ['class' => 'form-control', 'id' => 'delivery_street']) }}
        </div>
        <div class="form-group">
            {{ Form::label(__('frontend/profile/index.house')) }}
            {{ Form::text('house', null,
             ['class' => 'form-control', 'id' => 'delivery_house']) }}
        </div>
    </div>
</div>
