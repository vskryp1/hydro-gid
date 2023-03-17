<div class="modal fade" id="selectFieldsExportModal" role="dialog">
    <div class="modal-dialog" style="width: 920px;">
        <div class="modal-content">
            <div class="modal-header">
                {!! Form::button('&times;', [
                    'class'        => 'close',
                    'data-dismiss' => 'modal',
                ]) !!}
                <h4 class="modal-title">
                    @lang('backend.which_fields_to_unload')
                </h4>
            </div>
            <div class="modal-body text-right">
                {!! Form::open([
                    'route'  => $route,
                    'method' => 'GET',
                ]) !!}
                @foreach($columns->chunk(3) as $chunk)
                    <div class="row">
                        @foreach($chunk as $column)
                            <div class="col-xs-4">
                                <div class="form-group">
                                    {!! Form::label('export_' . $column, __('backend.' . $column)) !!}
                                    {!! Form::checkbox('export_fields[' . $column . ']', $column, $column === 'id', [
                                        'id'    => 'export_' . $column,
                                        'class' => 'form-control js-switch',
                                    ]) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                {!! Form::submit(__('backend.export'), [
                    'class' => 'btn btn-primary',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>