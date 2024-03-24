<div class="delivery personal__tab-content">
    <div class="personal__tab-title">
        @lang('frontend/profile/index.my_addresses')
    </div>
    <div class="store-address-form__wrap">
        @isset($data['addresses'])
            @foreach($data['addresses'] as $i => $address)
                @php(++$i)
                {!! Form::open([
                    'id'     => 'update-address-form-' . $i,
                    'route'  => ['frontend.forms.address.update', $address],
                    'method' => 'PATCH',
                    'enctype' => 'multipart/form-data',
                     'class' => 'store-address-form--half',
                ]) !!}
                <div class="details__input editForm address_block">
                    <div class="address_block__title">
                        @lang('frontend/profile/index.exists', ['number' => $i])
                    </div>
                    <div class="details__input-col">
                        <label for="inputCity_{{ $i }}" class="personal__label">
                            @lang('frontend/profile/index.city')
                        </label>
                        {!! Form::select(
                            'place_id',
                            $address->delivery_place ? $address->delivery_place->delivery_place : [$address->place_id => $address->city],
                            $address->delivery_place->id ?? null,
                            [
                                'id'    => 'inputCity_' . $i,
                                'class' => 'form-control personal__input delivery-select',
                                'required',
                                'disabled' => 'disabled',
                                'data-url' => route('ajax.cart.delivery_place', [$data['courier_delivery']->id, true])
                            ]
                        ) !!}
                        <label for="inputStreet_{{ $i }}" class="personal__label">
                            @lang('frontend/profile/index.street')
                        </label>
                        {!! Form::text('street', $address->street, [
                            'id'    => 'inputStreet_' . $i,
                            'class' => 'form-control personal__input',
                            'required','readonly',
                        ]) !!}
                        <label for="inputHouse_{{ $i }}" class="personal__label">
                            @lang('frontend/profile/index.house')
                        </label>
                        {!! Form::text('house', $address->house, [
                            'id'    => 'inputHouse_' . $i,
                            'class' => 'form-control personal__input',
                            'required','readonly',
                        ]) !!}
                    </div>
                </div>
                <div class="per_edit" style="display: none">

                    <div data-block-save class="personal__cans">
                        {!! Form::button(__('frontend/profile/index.cancel'), [
                            'class' => 'btn btn-lg btn-safe', 'type' => 'reset'
                        ]) !!}
                    </div>

                    <div class="personal__save">
                        {!! Form::button(__('frontend/profile/index.save'), [
                            'type' => 'submit',
                            'form' => 'update-address-form-' . $i
                        ]) !!}
                    </div>
                </div>

                <div class="personal__edit" data-block-edit>
                    {!! Form::button(__('frontend/profile/index.edit'), [
                        'class' => 'btn edit-btn', 'type' => 'button'
                    ]) !!}
                    <button type="submit" class="btn btn-xs btn-danger" form='delete-address-form-{{ $i }}'>@lang('frontend/profile/index.delete')</button>
                </div>
                {!! Form::close() !!}
                {{ Form::open([
                   'route' => ['frontend.forms.address.destroy', $address], 'method' => 'delete','class' => 'form-delete', 'id' => 'delete-address-form-' . $i]) }}
                {{ Form::close() }}
            @endforeach
        @endisset
    </div>
    {!! Form::open([
    'id'     => 'store-address-form',
    'route'  => ['frontend.forms.address.store'],
    'method' => 'POST',
    'class' => 'store-address-form--full',
]) !!}
    {{--    {!! Form::hidden('place_id', '', ['id' => 'id']) !!}--}}
    <div class="details__input address_block">
        <div class="address_block__title">
            @lang('frontend/profile/index.new')
        </div>
        <div class="details__input-col">
            <label for="inputCity" class="personal__label">
                @lang('frontend/profile/index.city')
            </label>
            {{ Form::select(
               'place_id',
               [],
               null,
               [
                   'class' => 'delivery-select form-control',
                   'data-url' => route('ajax.cart.delivery_place', [$data['courier_delivery']->id, true])
               ]
           ) }}
            <label for="inputStreet" class="personal__label">
                @lang('frontend/profile/index.street')
            </label>
            {!! Form::text('street', null, [
                'id'    => 'inputStreet',
                'class' => 'form-control personal__input',
                'required',
            ]) !!}
            <label for="inputHouse" class="personal__label">
                @lang('frontend/profile/index.house')
            </label>
            {!! Form::text('house', null, [
                'id'    => 'inputHouse',
                'class' => 'form-control personal__input',
                'required',
            ]) !!}
        </div>
    </div>
    <div class="personal__edit">
        {!! Form::button(__('frontend/profile/index.create'), [
            'type' => 'submit',
        ]) !!}
    </div>
    {!! Form::close() !!}
</div>
