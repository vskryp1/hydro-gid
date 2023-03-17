<div class="col-md-6 col-md-offset-3">
    <div class="form-group">
        <label for="template-name">@lang('backend.name')</label>
        {!! Form::text('name', null,['class'=>'form-control','placeholder'=>__('backend.name'),'required','id'=>'template-name']) !!}
    </div>
    <div class="form-group">
        <label for="template-template">@lang('backend.template')</label>
        {!! Form::select('template_id', $templates, null, ['class'=>'form-control','placeholder'=>__('backend.template'),'required','id'=>'template-body']) !!}

    </div>
</div>

@include('backend.elements.save_buttons', ['back_link' => route('backend.mail.email.templates.index')])
@isset($template)
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <a href="{{ route('backend.mail.newsletter.start', ['template' => $template->id]) }}" class="btn btn-warning text-uppercase pull-right">
            <i class="fa fa-send"></i> @lang('backend.start_newsletter')
        </a>
    </div>
@endisset
