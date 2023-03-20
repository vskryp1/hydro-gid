<div class="dz-preview dz-file-preview">
    <div class="dz-hover">
        <div class="dz-image">
            @isset($image)
                {!! Html::image($image->getUrl('prod_md'), $image->alt, [
                    'data-dz-thumbnail',
                    'height' => 120,
                    'width'  => 120,
                    'style'  => 'object-fit:cover;object-position:center;'
                ]) !!}
            @else
                {!! Html::image('', '', [
                    'data-dz-thumbnail',
                    'height' => 120,
                    'width'  => 120,
                    'style'  => 'object-fit:cover;object-position:center;'
                ]) !!}
            @endisset
        </div>
        <div class="dz-details" style="display: none">
            <div class="dz-size"><span data-dz-size></span></div>
            <div class="dz-filename"><span data-dz-name></span></div>
        </div>
        <div class="dz-progress" style="display: none"><span class="dz-upload" data-dz-uploadprogress></span></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="dz-success-mark">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <title>Check</title>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                          id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475"
                          fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                </g>
            </svg>
        </div>
        <div class="dz-error-mark">
            <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                <title>Error</title>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                    <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158"
                       fill="#FFFFFF" fill-opacity="0.816519475">
                        <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z"
                              id="Oval-2" sketch:type="MSShapeGroup"></path>
                    </g>
                </g>
            </svg>
        </div>
    </div>
    <br>
    <div class="row">
        <button type="button" class="btn btn-primary btn-xs col-md-12" data-toggle="modal"
                data-target="#image-attributes-{{$loop->iteration??'<index>'}}"><i class="fa fa-edit"></i> @lang('backend.attributes_edit')
        </button>
    </div>
    <div class="row">
        <button type="button" data-dialog="@lang('backend.delete_question')" class="btn btn-danger btn-xs col-md-12" data-dz-remove><i class="fa fa-trash"></i> @lang('backend.remove')
        </button>
    </div>
    <div class="modal fade image-attributes" id="image-attributes-{{$loop->iteration??'<index>'}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">@lang('backend.attributes_image')</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="images[{{$loop->iteration??'<index>'}}][image]" value="@isset($image){{$image->getOriginal('image')}}@endisset" data-image-name value="">

                    <div class="row tabs-vertical-env tabs-vertical-bordered">
                        <ul class="nav tabs-vertical" role="tablist"
                            aria-orientation="vertical">
                            @foreach(Setting::get('locales') as $lang => $locale)
                                <li class=" @if($loop->first) active @endif">
                                    <a class="nav-link" id="image-{{$loop->parent->iteration??'<index>'}}-locales-{{ $lang }}-tab" data-toggle="pill"
                                       href="#image-{{$loop->parent->iteration??'<index>'}}-locales-{{ $lang }}" role="tab" aria-controls="image-{{$loop->parent->iteration??'<index>'}}-locales-{{ $lang }}"
                                       aria-selected="true">
                                        {{ strtoupper($lang) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="image-{{$loop->parent->iteration??'<index>'}}-ls-{{ $lang }}-tab" >
                            @foreach(Setting::get('locales') as $lang => $locale)
                                <div class="tab-pane fade @if($loop->first)in active @endif"
                                     id="image-{{$loop->parent->iteration??'<index>'}}-locales-{{ $lang }}"
                                     aria-labelledby="image-{{$loop->parent->iteration??'<index>'}}-locales-{{ $lang }}-tab"
                                     role="tabpanel">
                                    <div class="form-group">
                                        <label>@lang('backend.alt')</label>
                                        {!! Form::text('images['.($loop->parent->iteration??'<index>').']['.$lang.'][alt]', $image->{'alt:'.$lang}??'',['class'=>'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('backend.title')</label>
                                        {!! Form::text('images['.($loop->parent->iteration??'<index>').']['.$lang.'][title]', $image->{'title:'.$lang}??'',['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('backend.close')</button>
                </div>

            </div>
        </div>
    </div>

</div>