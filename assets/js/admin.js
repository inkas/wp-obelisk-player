jQuery(document).ready(function ($) {
    $('.alert').on('close.bs.alert', function () {
        $(this).fadeOut();

        return false;
    });

    $.fn.serializeFormJSON = function () {
        var o = {};
        var a = this.serializeArray();

        $.each(a, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }

                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });

        return o;
    };

    $('.obelisk-form.ajax').submit(function (e) {
        e.preventDefault();

        var data = $(this).serializeFormJSON(),
            $form = $(this),
            $alert = $form.closest('.tab-content').find('.alert'),
            $alertMessage = $alert.find('.message');

        data.nonce = ajax_object.nonce;

        $alert.removeClass('alert-success alert-danger');

        $.ajax({
            type: 'POST',
            data: data,
            url: ajax_object.ajax_url,
            success: function (response) {
                if (!response.hasOwnProperty('success')) {
                    // Fail
                    $alertMessage.text('Oops. Something went wrong. Please try again.');
                    $alert.addClass('alert-danger').hide().fadeIn();

                    return;
                }

                $alertMessage.text(response.data.message);

                if (response.success) {
                    // Success
                    $alert.addClass('alert-success').hide().fadeIn();
                } else {
                    // Fail
                    $alert.addClass('alert-danger').hide().fadeIn();
                }

                switch (response.data.action) {
                    case 'delete_row':
                        $form.closest('tr').fadeOut(function () {
                            $(this).remove();
                        });

                        break;
                }
            },

            error: function () {
                // Fail
                $alertMessage.text('Oops. Something went wrong. Please try again.');
                $alert.addClass('alert-danger').hide().fadeIn();
            }
        });
    });
});