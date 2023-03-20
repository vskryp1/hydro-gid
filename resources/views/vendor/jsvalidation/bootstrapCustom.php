<script>
    jQuery(document).ready(function () {
        var submitSetted        = false;
        var errorElementHandler = function (errorList) {
            var elementName = Object.keys(errorList)[0];
            var $errElement = $('input[name="' + elementName + '"]');
            var tabs        = $errElement.parents('.tab-pane');
            if (tabs) {
                $.each(tabs, function (index, value) {
                    $('a[href="#' + value.id + '"]').trigger('click');
                });
            }
            if ($errElement.offset()) {
                $('html, body').animate({
                    scrollTop: $errElement.offset().top
                }, <?= Config::get('jsvalidation.duration_animate') ?>);
            }
            $errElement.focus();
        }
        $("<?= $validator['selector']; ?>").each(function () {
            $(this).validate({
                errorElement  : 'span',
                errorClass    : 'help-block error-help-block',
                errorPlacement: function (error, element) {
                    if (!$(error).text()) {
                        return;
                    }
                    if (element.parent('.input-group').length ||
                        element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                        error.insertAfter(element.parent());
                        // else just place the validation message immediately after the input
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight     : function (element) {
                    $(element)
                        .addClass('parsley-error')
                        .closest('.form-group')
                        .removeClass('has-success')
                        .addClass('has-error');
                },
                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                ignore: "<?= $validator['ignore']; ?>",
                <?php endif; ?>

                // // Uncomment this to mark as validated non required fields
                unhighlight: function (element) {
                    $(element).removeClass('parsley-error')
                    $(element).closest('.form-group').removeClass('has-error');
                },

                success       : function (element) {
                    $(element).removeClass('parsley-error');
                },
                focusInvalid  : true, // do not focus the last invalid input
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {
                    if (!validator.numberOfInvalids())
                        return;
                    errorElementHandler(validator.invalid);
                    if (!submitSetted) {
                        // var fewSeconds = 0.01;
                        submitSetted = true;
                        $(form.target).find('button[type="submit"]').click(function () {
                            if (validator.numberOfInvalids()) {
                                errorElementHandler(validator.invalid);
                            }
                            // if problems with clicks appears again
                            // var btn = $(this);
                            // console.warn('disabled');
                            // btn.prop('disabled', true);
                            // setTimeout(function () {
                            //     console.warn('active');
                            //     btn.prop('disabled', false);
                            // }, fewSeconds * 1000);
                        });
                    }

                },
                <?php endif; ?>
                rules         : <?= json_encode($validator['rules']); ?>
            });
        });
    });
</script>
