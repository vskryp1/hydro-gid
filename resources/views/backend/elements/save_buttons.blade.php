<div class="col-12 col-sm-12 col-md-12 col-lg-12">
    {!! Form::hidden('action') !!}
    @isset($auth_link, $client)
        <a href="{{ $auth_link }}" class="btn btn-default pull-right" target="_blank">
            <i class="fa fa-user"></i>
            {{ __('backend.auth_client') }}
        </a>
    @endisset
    @isset($permission)
        @can('delete ' . $permission)
            @isset($model, $restore_link)
                @if($model->deleted_at)
                    <a href="{{ $restore_link }}" class="btn btn-warning text-uppercase pull-right">
                        <i class="fa fa-refresh"></i>
                        {{ __('backend.restore') }}
                    </a>
                @endif
            @endisset
            @isset($destroy_link)
                <a href="{{ $destroy_link }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ __('backend.delete_question') }}" class="btn btn-danger text-uppercase pull-right" title="{{ __('backend.delete') }}">
                    <i class="fa fa-trash"></i>
                    {{ __('backend.delete') }}
                </a>
            @endisset
        @endcan
        @can('add ' . $permission)
            @isset($copy_link)
                <a href="{{ $copy_link }}" data-method="POST" data-token="{{ csrf_token() }}" class="btn btn-dark text-uppercase pull-right">
                    <i class="fa fa-copy"></i>
                    {{ __('backend.copy') }}
                </a>
            @endisset
        @endcan
        @can('export ' . $permission)
            @isset($export_link)
                @if(!(isset($model) && $model->deleted_at))
                    <a href="{{ $export_link }}" class="btn btn-default text-uppercase pull-right">
                        <i class="fa fa-download"></i>
                        {{ __('backend.export') }} (XLSX)
                    </a>
                @endif
            @endisset
        @endcan
    @endisset
    @isset($show_link)
        <a href="{{ $show_link }}" target="_blank" type="submit" class="btn btn-default text-uppercase pull-right">
            <i class="fa fa-eye"></i>
            @lang('backend.show')
        </a>
    @endisset
    <button type="submit" data-action="continue" class="btn btn-info text-uppercase pull-right">
        <i class="fa fa-refresh"></i>
        {{ __('backend.save_continue') }}
    </button>
    <button type="submit" class="btn btn-primary text-uppercase pull-right">
        <i class="fa fa-save"></i>
        {{ __('backend.save') }}
    </button>
    @isset($back_link)
        <a href="{{ $back_link }}" data-dialog="{{ __('backend.want_to_go_back') }}" data-do="link" class="btn btn-dark text-uppercase pull-right">
            <i class="fa fa-reply"></i>
            {{ __('backend.back') }}
        </a>
    @endisset
    @if(isset($products_link) && $products_link != '')
        <a href="{{ $products_link }}" class="btn btn-info text-uppercase pull-right">
            <i class="fa fa-cubes"></i>
            {{ __('backend.category_products') }}
        </a>
    @endif
    @isset($reset_sort)
        <a href="{{ $reset_sort }}" class="btn btn-danger text-uppercase pull-right">
            <i class="fa fa-cut"></i>
            {{ __('backend.reset_sort') }}
        </a>
    @endisset
</div>