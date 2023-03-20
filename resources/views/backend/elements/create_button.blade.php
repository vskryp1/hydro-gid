@if(isset($create_link) && isset($name) && (isset($permission) || isset($custom_permission)))
    @can($custom_permission ?? 'add ' . $permission)
        <div class="row">
            <div class="col-6 col-md-8 col-lg-10"></div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ $create_link }}" class="btn btn-block btn-sm btn-success text-uppercase">
                    <i class="fa fa-plus"></i>
                    {{ $name }}
                </a>
            </div>
        </div>
    @endcan
@endif