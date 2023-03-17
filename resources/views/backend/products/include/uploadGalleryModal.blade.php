<div class="modal fade upload-image-modal" id="upload-image-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">@lang('backend.images_upload')</h4>
            </div>
            <div class="modal-body">
                <p>@lang('backend.drag_faq')</p>
                <form action="{{route('backend.products.gallery', ['product' => isset($product) ? $product->id : 'tmp'])}}" method="post"
                      class="dropzone" id="galleries" enctype="multipart/form-data">
                    @csrf
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('backend.close')</button>
            </div>

        </div>
    </div>
</div>

