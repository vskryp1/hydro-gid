@isset($errors)
    @if($errors->any())
        <script>
            new PNotify({
                title: '@lang('backend.error_title')',
                text: '{{ collect($errors->all())->implode(' ') }}',
                type: 'error',
                styling: 'bootstrap3'
            });
        </script>
    @endif
@endisset

@if(session('success'))
    <script>
        new PNotify({
            title: '{{ session('success.title') ?? __('backend.success_title') }}',
            text: '{{ session('success.text') }}',
            type: 'success',
            styling: 'bootstrap3'
        });
    </script>
@endif

@if(session('info'))
    <script>
        new PNotify({
            title: '{{ session('info.title') ?? __('backend.info_title') }}',
            text: '{{ session('info.text') }}',
            type: 'info',
            styling: 'bootstrap3'
        });
    </script>
@endif

@if(session('error'))
    <script>
        new PNotify({
            title: '{{ session('error.title') ?? __('backend.error_title') }}',
            text: '{{ session('error.text') }}',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
@endif

<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <p class="js_message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" id="confirmBtnNo">
                    @lang('backend.no')
                </button>
                <button type="button" class="btn btn-info" id="confirmBtnYes">
                    @lang('backend.yes')
                </button>
            </div>
        </div>
    </div>
</div>