<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a class="nav-link" id="base-tab" data-toggle="tab" href="#base" data-tab="#base" role="tab"
               aria-controls="home" aria-selected="true">
                @lang('backend.base') </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base" role="tabpanel"
             aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div>
                        <div class="form-group">
                            <label for="roleName">@lang('backend.name')</label>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=> __('backend.name'),'required','id'=>'roleName']) !!}
                        </div>
                        <div class="checkbox">
                            {!! Form::hidden('active', 0) !!}
                            {!! Form::checkbox('active', 1, null, ['class' => 'js-switch']) !!}
                            @lang('backend.active')
                        </div>
                        @if(auth('admin')->user()->isSuperAdmin())
                            <div class="form-group">
                                @foreach($permissions as $permission)
                                    <div>
                                        {!! Form::checkbox('roles[]', $permission->name, isset($role) && $role->hasPermissionTo($permission->name), ['id' => 'permission-'.$permission->id]) !!}
                                        <label for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h4 class="text text-info text-center">
                                <i class="fa fa-exclamation-circle"></i>
                                @lang('Here will be appear FRONTEND permissions')
                            </h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.roles.index')])