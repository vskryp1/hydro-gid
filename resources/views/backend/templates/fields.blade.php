<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_content">

        <div class="col-md-1 col-sm-1 col-xs-1">
            <!-- required for floating -->
            <!-- Nav tabs -->
            <ul class="nav nav-tabs tabs-left">
                @foreach($langs as $lang => $locale)
                    <li class="@if($lang == App::getLocale()) active @endif">
                        <a class="nav-link"
                           id="v-pills-{{ $lang }}-tab"
                           data-toggle="pill"
                           href="#v-pills-{{ $lang }}"
                           role="tab"
                           aria-controls="v-pills-{{ $lang }}"
                           aria-selected="true">{{ strtoupper($lang) }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-xs-11">
            <!-- Tab panes -->
            <div class="tab-content">
                @foreach($langs as $lang => $values)
                    <div class="tab-pane @if($lang == App::getLocale()) active @endif" id="v-pills-{{ $lang }}">
                        <div class="form-group">
                            <label for="template-name">@lang('backend.name')</label>
                            {!! Form::text($lang . "[name]",(isset($template) && $template->hasTranslation($lang)) ? $template->translate($lang)->name : null,['class'=>'form-control required','placeholder'=>'Name...', 'id'=>'template-name', 'data-validation'=>'required', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="template-body">@lang('backend.body')</label>
                            {!! Form::textarea($lang. "[body]", (isset($template) && $template->hasTranslation($lang)) ? $template->translate($lang)->body : null, ['class'=>'form-control ck-editor','placeholder'=>'Body...', 'id'=>'template-body']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="clearfix"></div>

        @include('backend.elements.save_buttons', ['back_link' => route('backend.mail.templates.index')])
    </div>
</div>
