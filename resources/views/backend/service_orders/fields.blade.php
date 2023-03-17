<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab" aria-controls="base" aria-selected="true">
                {{ __('backend.base') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel" aria-labelledby="base-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label for="input-type">
                            {{ __('backend/service/index.type') }}
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::select('type', ServiceType::toSelectArray(), isset($serviceOrder) ? $serviceOrder->type : null, [
                            'id'       => 'input-type',
                            'class'    => 'form-control',
                            'disabled' => isset($serviceOrder)
                        ]) !!}
                    </div>
                    @if(empty($serviceOrder) || (isset($serviceOrder) && $serviceOrder->type->is(ServiceType::ORDER)))
                        <div class="form-group">
                            <label for="inputService">
                                {{ __('backend/service/index.service') }}
                                <span class="text-danger">*</span>
                            </label>
                            {!! Form::select('page_id', $services, null, [
                                'id'       => 'inputService',
                                'class'    => 'form-control',
                            ]) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="inputUserName">
                            {{ __('backend/service/index.username') }}
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::text('username', null, [
                            'id'       => 'inputUserName',
                            'class'    => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">
                            {{ __('backend/service/index.email') }}
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::email('email', null, [
                            'id'       => 'inputEmail',
                            'class'    => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputPhone">
                            {{ __('backend/service/index.phone') }}
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::text('phone', null, [
                            'id'       => 'inputPhone',
                            'class'    => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputIsActive">
                            {{ __('backend/service/index.active') }}
                        </label><br>
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active', 1, null, [
                            'id'    => 'inputIsActive',
                            'class' => 'js-switch',
                        ]) !!}
                    </div>
                    @if(empty($serviceOrder)
                        || (isset($serviceOrder) && ($serviceOrder->type->in([ServiceType::CALLBACK, ServiceType::QUESTION, ServiceType::CONTACT])))
                    )
                        @if( isset($serviceOrder) && $serviceOrder->type->is(ServiceType::CALLBACK))
                            <div class="form-group">
                                <label for="input-call-me">
                                    {{ __('backend/service/index.call_me') }}
                                </label><br>
                                {!! Form::hidden('call_me', 0) !!}
                                {!! Form::checkbox('call_me', 1, null, [
                                    'id'    => 'input-call-me',
                                    'class' => 'js-switch',
                                ]) !!}
                            </div>
                        @endif
                        @if(isset($serviceOrder) && $serviceOrder->file && $serviceOrder->getFileUrl())
                            <a href="{{ $serviceOrder->getFileUrl() }}" target="_blank">
                                @lang('backend/service/index.download_file')
                            </a>
                        @endif
                        <div class="form-group">
                            <label for="input-file">
                                {{ __('backend/service/index.upload_file') }}
                            </label><br>
                            {!! Form::file('uploaded_file', ['id' => 'input-file']) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="inputComment">
                            {{ __('backend/service/index.comment') }}
                            <span class="text-danger">*</span>
                        </label>
                        {!! Form::textarea('comment', null, [
                            'id'    => 'inputComment',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.elements.save_buttons', ['back_link' => route('backend.service-orders.index')])