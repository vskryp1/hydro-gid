<ul id="clientTabs" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#base" id="base-tab" role="tab" data-toggle="tab" aria-controls="base" aria-expanded="true">
            @lang('backend.base')
        </a>
    </li>
    <li role="presentation">
        <a href="#discount" id="discount-tab" role="tab" data-toggle="tab" aria-controls="discount" aria-expanded="false">
            @lang('backend.discount')
        </a>
    </li>
    <li role="presentation">
        <a href="#address" role="tab" id="address-tab" data-toggle="tab" aria-controls="address" aria-expanded="false">
            @lang('backend.address')
        </a>
    </li>
</ul>
<div id="clientTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="base" aria-labelledby="base-tab">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="inputFirstName" class="control-label">
                        @lang('backend/profile/index.first_name')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::text('first_name', $client->first_name ?? old('first_name'), [
                        'id'           => 'inputFirstName',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputLastName" class="control-label">
                        @lang('backend/profile/index.last_name')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::text('last_name', $client->last_name ?? old('last_name'), [
                        'id'           => 'inputLastName',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputPhone" class="control-label">
                        @lang('backend/profile/index.phone')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::tel('phone', $client->phone ?? old('phone'), [
                        'id'           => 'inputPhone',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">
                        @lang('backend/profile/index.email')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::email('email', $client->email ?? old('email'), [
                        'id'           => 'inputEmail',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                @if(auth('admin')->user()->hasRole(UserType::ROLE_SUPER_ADMIN))
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">
                            @lang('backend/profile/index.password')
                        </label>
                        {!! Form::password('password', [
                            'id'           => 'inputPassword',
                            'class'        => 'form-control',
                            'autocomplete' => 'new-password',
                        ]) !!}
                    </div>
                @endif
                <div class="form-group">
                    <label for="inputIsLegalEntity" class="control-label">
                        @lang('backend/profile/index.i_am_legal_entity')
                    </label><br>
                    {!! Form::hidden('is_legal_entity', 0) !!}
                    {!! Form::checkbox('is_legal_entity', 1, $client->is_legal_entity ?? old('is_legal_entity'), [
                        'id'    => 'inputIsLegalEntity',
                        'class' => 'js-switch',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputCompanyName" class="control-label">
                        @lang('backend/profile/index.company_name')
                    </label>
                    {!! Form::text('company_name', $client->company_name ?? old('company_name'), [
                        'id'           => 'inputCompanyName',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputEdrpou" class="control-label">
                        @lang('backend/profile/index.edrpou')
                    </label>
                    {!! Form::number('edrpou', $client->edrpou ?? old('edrpou'), [
                        'id'           => 'inputEdrpou',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputIsActive" class="control-label">
                        @lang('backend/profile/index.is_active')
                    </label><br>
                    {!! Form::hidden('is_active', 0) !!}
                    {!! Form::checkbox('is_active', 1, $client->is_active ?? old('is_active'), [
                        'id'    => 'inputIsActive',
                        'class' => 'js-switch',
                    ]) !!}
                </div>
                @if(isset($client) && !$client->email_verified_at)
                    <div class="form-group">
                        <label for="inputEmailVerify" class="control-label">
                            @lang('backend/profile/index.verify')
                        </label><br>
                        {!! Form::hidden('email_verify', 0) !!}
                        {!! Form::checkbox('email_verify', 1, 0, ['class' => 'js-switch']) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="discount" aria-labelledby="discount-tab">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-group">
                    <label for="inputDiscount" class="control-label">
                        @lang('backend/profile/index.discount')
                        <span class="text text-danger">*</span>
                    </label>
                    {!! Form::number('discount', $client->discount ?? old('discount'), [
                        'id'           => 'inputDiscount',
                        'class'        => 'form-control',
                        'autocomplete' => 'off',
                        'min'          => 0,
                    ]) !!}
                </div>
                <div class="form-group">
                    <label for="inputIsPercentage" class="control-label">
                        @lang('backend/profile/index.is_percentage')
                    </label><br>
                    {!! Form::hidden('is_percentage', 0) !!}
                    {!! Form::checkbox('is_percentage', 1, $client->is_percentage ?? old('is_percentage'), [
                        'id'    => 'inputIsPercentage',
                        'class' => 'js-switch',
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="address" aria-labelledby="address-tab">
        @isset($client)
            <div class="row">
                <div class="pull-right">
                    <a href="{{ route('backend.clients.addresses.create', ['client' => $client]) }}" class="btn btn-success">
                        @lang('backend.create_address')
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                @lang('backend/profile/index.city')
                            </th>
                            <th scope="col">
                                @lang('backend/profile/index.street')
                            </th>
                            <th scope="col">
                                @lang('backend/profile/index.house')
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($client->addresses as $index => $address)
                            <tr>
                                <th scope="row">
                                    {{ ++$index }}
                                </th>
                                <td>{{ $address->delivery_place ? $address->delivery_place->name : '' }}</td>
                                <td>{{ $address->street }}</td>
                                <td>{{ $address->house }}</td>
                                <td class="pull-right">
                                    <a href="{{ route('backend.clients.addresses.edit', ['client' => $client, 'address' => $address]) }}" class="btn btn-primary">
                                        @lang('backend.edit')
                                    </a>
                                    <a data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="@lang('backend.delete_question')" href="{{ route('backend.clients.addresses.destroy', ['client' => $client, 'address' => $address]) }}" class="btn btn-danger">
                                        @lang('backend.delete')
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th colspan="5">
                                    <div class="text-center">
                                        <h4>
                                            <i class="fa fa-info-circle"></i>
                                            @lang('backend.nothing_found')
                                        </h4>
                                    </div>
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center">
                <h4>
                    <i class="fa fa-info-circle"></i>
                    @lang('backend.you_need_create_client')
                </h4>
            </div>
        @endisset
    </div>
</div>

@include('backend.elements.save_buttons', [
    'back_link' => route('backend.clients.index'),
])