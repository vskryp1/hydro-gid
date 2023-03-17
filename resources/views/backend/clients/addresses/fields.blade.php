<ul id="clientTabs" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#base" id="base-tab" role="tab" data-toggle="tab" aria-controls="base" aria-expanded="true">
            @lang('backend.base')
        </a>
    </li>
</ul>
<div id="clientTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="base" aria-labelledby="base-tab">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="inputCity" class="control-label">
                        @lang('backend/profile/index.city')
                        <span class="text text-danger">*</span>
                    </label>
                    {{ Form::select(
                                   'place_id',
                                   $deliveryPlaces ?? [],
                                   $address->delivery_place->api_id ?? '',
                                   [
                                     'class'           => 'form-control js-select-places',
                                     'id'              => 'city',
                                     'data-delivery'   => $deliveryId,
                                   ]
                     )}}
                </div>
                <div class="form-group">
                    <label for="inputStreet" class="control-label">
                        @lang('backend/profile/index.street')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::text('street', $address->street ?? old('street'), [
                        'id'           => 'inputStreet',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputHouse" class="control-label">
                        @lang('backend/profile/index.house')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::text('house', $address->house ?? old('house'), [
                        'id'           => 'inputHouse',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', [
    'back_link' => route('backend.clients.edit', ['client' => $client]),
])