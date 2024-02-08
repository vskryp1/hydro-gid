<div class="root-tab tab-pane fade" id="additional-fields" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row tabs-vertical-env tabs-vertical-bordered">
        <ul class="nav tabs-vertical" id="v-pills-tab" role="tablist"
            aria-orientation="vertical">
            @foreach(Setting::get('locales') as $lang => $locale)
                <li class="@if ($loop->first) active @endif">
                    <a class="nav-link"
                       id="v-pills-{{ $lang }}-tab"
                       data-toggle="pill"
                       href="#v-pills-{{ $lang }}"
                       role="tab"
                       aria-controls="v-pills-{{ $lang }}"
                       aria-selected="true">{{ strtoupper($lang) }}
                    </a>
                </li>
            @endforeach
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            @foreach(Setting::get('locales') as $lang => $locale)
                <div class="tab-pane  @if ($loop->first) active @endif" id="v-pills-{{ $lang }}">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <td width="250px">@lang('backend.name')</td>
                        <td width="150px">@lang('backend.type')</td>
                        <td>@lang('backend.value')</td>
                        </thead>
                        <tbody>
                        @forelse($page_add_fields as $field)
                            @php($value = $field->page_additional_field_value->where('page_id', $page->id)->first() && $field->page_additional_field_value->where('page_id', $page->id)->first()->translate($lang)
                                  ? $field->page_additional_field_value->where('page_id', $page->id)->first()->translate($lang)->value
                                  : null)
                            @php($type = $field->page_additional_field_type->type)
                            <tr>
                                <td>
                                    {{ $field->name }}<br>
                                </td>
                                <td>{{ $type }}</td>
                                <td>
                                    @if($type == 'file')
                                        {!! Form::text('add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]', $value)!!}
                                    @endif
                                    @if($type == 'checkbox')
                                        {!! Form::hidden('add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]', false)!!}
                                        {!! Form::checkbox('add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]', 1, $value)!!}
                                    @else
                                        {!! Form::{$type}('add['. $type .']' . '[' . $field->id . ']' . '[' . $lang . '][value]',
                                                                                $type == 'file' ? null : $value,
                                                                                ['class' => 'form-control']
                                                                            )!!}
                                    @endif
                                    @if($type == 'file' && $value != '' && Storage::disk('public')->exists(\App\Models\Page\Page::GALLERY_PATH. $page->id . '/' . $value))
                                        <img src="{{ asset("/storage/pages/$page->id/$value") }}" width="100px">
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">@lang('backend.nothing_found')</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
    <div class="clearfix"></div>
</div>