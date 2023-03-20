<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    @if(isset($model) && $model->deleted_at && isset($restore_link) && $restore_link && isset($permission))
        @can('delete ' . $permission)
            <a href="{{ $restore_link }}" data-method="PUT" data-token="{{ csrf_token() }}" class="btn btn-info btn-sm text-uppercase pull-right">
                <i class="fa fa-refresh"></i>
                <span class="hidden-xs hidden-sm hidden-md">
                    {{ __('backend.restore') }}
                </span>
            </a>
        @endcan
    @endif
    @if(isset($destroy_link) && $destroy_link && isset($permission))
        @can('delete ' . $permission)
            <a href="{{$destroy_link}}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ __('backend.delete_question') }}" class="delete-btn btn btn-danger btn-sm text-uppercase pull-right disabled-link" title="{{ __('backend.delete') }}" disabled>
                <i class="fa fa-trash"></i>
                <span class="hidden-xs hidden-sm hidden-md">
                    {{ __('backend.delete') }}
                </span>
            </a>
        @endcan
    @endif
    @if(isset($edit_link) && $edit_link && isset($permission) && !(isset($model) && $model->deleted_at))
        @can('edit ' . $permission)
            <a href="{{$edit_link}}" class="btn btn-sm btn-primary text-uppercase pull-right">
                <i class="fa fa-edit"></i>
                <span class="hidden-xs hidden-sm hidden-md">
                    {{ __('backend.edit') }}
                </span>
            </a>
        @endcan
    @endif
</div>