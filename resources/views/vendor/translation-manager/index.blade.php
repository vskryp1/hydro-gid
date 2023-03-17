@extends('backend.layouts.backend')

@section('title', __('backend.translations'))

@section('content')
    <div class="alert alert-success success-import" style="display:none;">
        @lang('backend.done_save2')
        <strong class="counter">
            N
        </strong>
        @lang('backend.done_save3')
    </div>
    <div class="alert alert-success success-find" style="display:none;">
        @lang('backend.done_save4')
        <strong class="counter">
            N
        </strong>
        @lang('backend.items')!
    </div>
    <div class="alert alert-success success-publish" style="display:none;">
        @lang('backend.done_save')
        {{ $group }}
    </div>
    <div class="alert alert-success success-publish-all" style="display:none;">
        @lang('backend.done_save5')
    </div>
    @if(Session::has('successPublish'))
        <div class="alert alert-info">
            {{ Session::get('successPublish') }}
        </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('backend.groups')
        </div>
        <div class="panel-body">
            @if(isset($group))
                <div>
                    <a href="{{ action('Backend\Settings\TranslationController@index') }}"
                       class="btn btn-primary pull-right">
                        @lang('backend.back')
                    </a>
                    @if(auth()->user()->hasPermissionTo('publish translations'))
                        {!! Form::open([
                            'class'       => 'form-inline form-publish',
                            'method'      => 'POST',
                            'url'         => action('\Barryvdh\TranslationManager\Controller@postPublish', $group),
                            'data-remote' => true,
                            'role'        => 'form',
                        ]) !!}
                        <button data-dialog="{{ __('backend.save_translation1') . ' ' . $group . ' ' . __('backend.save_translation2')}}"
                                type="submit" class="btn btn-info">
                            @lang('backend.publish_translate')
                        </button>
                        {!! Form::close() !!}
                    @endif
                </div>
            @endif
            {!! Form::open([
                'method' => 'POST',
                'url'    => action('\Barryvdh\TranslationManager\Controller@postAddGroup'),
                'role'   => 'form',
            ]) !!}
            <div class="form-group">
                <label for="group">
                    @lang('backend.choose_group')
                </label>
                <select name="group" id="group" class="form-control group-select">
                        @foreach(App\Enums\TranslationType::getDescriptions() as $groupName => $values)
                            <optgroup label="{{ $groupName }}">
                                @foreach($values as $key => $value)
                                    <option value="{{ collect(explode('/', $key))->implode('.') }}"
                                            @if(collect(explode('/', $key))->implode('.') == request()->route('groupKey')) selected @endif>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="new-group">
                    @lang('backend.enter_new_group')
                </label>
                <input name="new-group" id="new-group" class="form-control" type="text"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="add-group" value="@lang('backend.add_new_group')"/>
            </div>
            {!! Form::close() !!}
            @if($group)
                {!! Form::open([
                    'method' => 'POST',
                    'url'    => action('\Barryvdh\TranslationManager\Controller@postAdd', $group),
                    'role'   => 'form',
                ]) !!}
                <div class="form-group">
                    <label for="keys">
                        @lang('backend.add_new_key')
                    </label>
                    <textarea name="keys" id="keys" rows="3" placeholder="@lang('backend.key_placeholder')"
                              class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" value="@lang('backend.add_keys')" class="btn btn-success"/>
                </div>
                {!! Form::close() !!}
                <hr>
                <h4>
                    @lang('backend.total'): {{ $numTranslations }},
                    @lang('backend.changed'): {{ $numChanged }}
                </h4>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width:15%;">
                                @lang('backend.key')
                            </th>
                            @foreach ($locales as $locale)
                                <th>{{ $locale }}</th>
                            @endforeach
                            @if ($deleteEnabled)
                                <th>&nbsp;</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($translations as $key => $translation)
                            <tr id="translate-{{ $key }}">
                                <td>
                                    {{ $key }}
                                </td>
                                @foreach ($locales as $locale)
                                    @php($t = $translation[$locale] ?? null)
                                    <td>
                                        <a href="#edit"
                                           class="editable status-{{ $t ? $t->status : 0 }} locale-{{ $locale }}"
                                           data-locale="{{ $locale }}"
                                           data-name="{{ $locale . "|" . $key }}"
                                           id="username"
                                           data-type="textarea"
                                           data-pk="{{ $t ? $t->id : 0 }}"
                                           data-url="{{ $editUrl }}"
                                           data-title="@lang('backend.enter_translation')">
                                            {{ $t ? htmlspecialchars_decode(htmlentities($t->value, ENT_QUOTES, 'UTF-8', false)) : '' }}
                                        </a>
                                    </td>
                                @endforeach
                                @if ($deleteEnabled)
                                    <td>
                                        <a href="{{ action('\Barryvdh\TranslationManager\Controller@postDelete', [$group, $key]) }}"
                                           class="delete-key btn btn-xs btn-danger"
                                           data-confirmed="@lang('backend.delete_translation') {{ $key }}?">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    @if(!$group)
        @if(auth()->user()->hasPermissionTo('manage languages'))
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('backend.supported_locales')
                </div>
                <div class="panel-body">
                    <fieldset>
                        {!! Form::open([
                            'class'  => 'form-add-locale',
                            'method' => 'POST',
                            'url'    => action('Backend\Settings\TranslationController@postAddLocale'),
                            'role'   => 'form',
                            'files'  => true,
                        ]) !!}
                        <div class="form-group">
                            <p>
                                @lang('backend.enter_new_key'):
                            </p>
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" id="basic-addon2" for="new-locale">
                                            ID:
                                        </label>
                                        <input id="new-locale" name="new-locale" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <label class="input-group-addon" id="basic-addon2" for="locale-name">
                                            NAME:
                                        </label>
                                        <input id="locale-name" name="locale_name" type="text" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <label class="input-group-addon" id="basic-addon2" for="locale-flag">
                                            Flag:
                                        </label>
                                        <input id="locale-flag" name="locale_flag" type="file" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-success btn-block">
                                        @lang('backend.add_new_locale')
                                    </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <p>
                            @lang('backend.current_supported'):
                        </p>
                        {!! Form::open([
                            'class'  => 'form-remove-locale form-horizontal',
                            'method' => 'POST',
                            'url'    => action('Backend\Settings\TranslationController@postRemoveLocale'),
                            'role'   => 'form',
                        ]) !!}
                        <div class="col-sm-6 col-sm-offset-3">
                            @foreach($locales as $locale)
                                <div class="form-group">
                                    <div class="col-sm-3 text-uppercase">
                                        {{ $locale }}
                                    </div>
                                    <div class="col-sm-4">
                                        {{ Setting::get('locales.' . $locale . '.name', '') }}
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Html::image('/assets/backend/images/flags/' . $locale . '.png', $locale, [
                                            'style' => 'height:15px;',
                                        ]) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        @if(count($locales) > 1)
                                            <input type="submit" name="remove-locale[{{ $locale }}]"
                                                   value="&times;"
                                                   class="btn btn-danger btn-xs"
                                                   data-disable-with="..."
                                                   data-dialog="@lang('backend.delete_locale_confirm')"/>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {!! Form::close() !!}
                    </fieldset>
                </div>
            </div>
        @endif
        @if(auth()->user()->hasPermissionTo('publish translations'))
            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('backend.import') / @lang('backend.export')
                </div>
                <div class="panel-body">
                    <fieldset>
                        {!! Form::open([
                            'class'  => 'form-inline form-publish-all',
                            'method' => 'POST',
                            'url'    => action('\Barryvdh\TranslationManager\Controller@postPublish', '*'),
                            'role'   => 'form',
                        ]) !!}
                        <button data-dialog="@lang('backend.publish_all_confirm')" type="submit"
                                class="btn btn-turquoise">
                            <i class="fa fa-save"></i>
                            <span>
                                    @lang('backend.publish_all')
                                </span>
                        </button>
                        {!! Form::close() !!}
                    </fieldset>
                    <fieldset>
                        {!! Form::open([
                            'class'  => 'form-inline form-gs-import',
                            'method' => 'POST',
                            'url'    => action('Backend\Settings\TranslationController@gsImport'),
                            'role'   => 'form',
                        ]) !!}
                        <button data-dialog="@lang('backend.gs_import_confirm')" type="submit" class="btn btn-success">
                            <i class="fa fa-desktop"></i>
                            <i class="fa fa-arrow-left"></i>
                            <i class="fa fa-table"></i>
                            <span>
                                    @lang('backend.gs_import')
                                </span>
                        </button>
                        {!! Form::close() !!}
                    </fieldset>
                    <fieldset>
                        {!! Form::open([
                            'class'  => 'form-inline form-gs-export',
                            'method' => 'POST',
                            'url'    => action('Backend\Settings\TranslationController@gsExport'),
                            'role'   => 'form',
                        ]) !!}
                        <button data-dialog="@lang('backend.gs_export_confirm')" type="submit" class="btn btn-info">
                            <i class="fa fa-desktop"></i>
                            <i class="fa fa-arrow-right"></i>
                            <i class="fa fa-table"></i>
                            <span>
                                    @lang('backend.gs_export')
                                </span>
                        </button>
                        {!! Form::close() !!}
                    </fieldset>
                </div>
            </div>
        @endif
    @endif
@endsection

@section('styles')
    {!! Html::style(mix('/assets/backend/css/translations.css')) !!}
@endsection
@section('scripts')
    {!! Html::script(mix('/assets/backend/js/translations.js')) !!}
    <script>
        $(document).ready(function ($) {
            $.ajaxSetup({
                            beforeSend: function (xhr, settings) {
                                settings.data += '&_token={{ csrf_token() }}';
                            }
                        });
            $('.editable').editable().on('hidden', function (e, reason) {
                var locale = $(this).data('locale');

                if (reason === 'save') {
                    $(this).removeClass('status-0').addClass('status-1');
                }

                if (reason === 'save' || reason === 'nochange') {
                    var $next = $(this).closest('tr').next().find('.editable.locale-' + locale);

                    setTimeout(function () {
                        $next.editable('show');
                    }, 300);
                }
            });
            $('.group-select').on('change', function () {
                var group = $(this).val();

                if (group) {
                    window.location.href = '{{ route('backend.settings.translations.view') }}/' + $(this).val();
                } else {
                    window.location.href = '{{ route('backend.settings.translations.index') }}';
                }
            });
            $('a.delete-key').click(function (event) {
                event.preventDefault();

                var $this = $(this);

                dialog($this.data('confirmed'),
                       function () {
                           var row = $this.closest('tr');
                           var url = $this.attr('href');
                           var id = row.attr('id');

                           $.post(url, {id: id}, function () {
                               row.remove();
                           });
                       }
                );
            });
            $('.form-import').on('ajax:success', function (e, data) {
                $('div.success-import strong.counter').text(data.counter);
                $('div.success-import').slideDown();
                window.location.reload();
            });
            $('.form-find').on('ajax:success', function (e, data) {
                $('div.success-find strong.counter').text(data.counter);
                $('div.success-find').slideDown();
                window.location.reload();
            });
            $('.form-publish').on('ajax:success', function () {
                $('div.success-publish').slideDown();
            });
            $('.form-publish-all').on('ajax:success', function () {
                $('div.success-publish-all').slideDown();
            });
            $('.form-gs-import, .form-gs-export').on('ajax:success', function () {
                window.location.reload();
            });
        })
    </script>
@endsection