<div class="form-group">
    <label for="active">
        @lang('backend.active')
    </label><br>
    {!! Form::hidden('active', 0) !!}
    {!! Form::checkbox('active', 1, null, [
        'id'    => 'active',
        'class' => 'js-switch'
    ]) !!}
</div>
<div class="form-group">
    <label for="is_category">
        @lang('backend.is_category')
    </label><br>
    {!! Form::hidden('is_category', 0) !!}
    {!! Form::checkbox('is_category', 1, null, [
        'id'    => 'is_category',
        'class' => 'js-switch'
    ]) !!}
</div>
<div class="form-group">
    <label for="name">
        @lang('backend.name')
        <span class="text-danger">*</span>
    </label>
    {!! Form::text('name', null, [
        'id'          => 'name',
        'class'       => 'form-control',
        'placeholder' => __('backend.name'),
        'required',
    ]) !!}
</div>
<div class="form-group">
    <label for="folder">
        @lang('backend.folder')
        <span class="text-danger">*</span>
    </label>
    {!! Form::text('folder', null, [
        'id'          => 'folder',
        'class'       => 'form-control',
        'placeholder' => __('backend.folder'),
        'required',
    ]) !!}
</div>
<div class="form-group">
    <label for="content">
        @lang('backend.content')
        <span class="text-danger">*</span>
    </label>
    {!! Form::textarea('content', null, [
        'id'          => 'content',
        'class'       => 'form-control',
        'placeholder' => __('backend.content'),
        'rows'        => 15,
        'required'
    ]) !!}
</div>