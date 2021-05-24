(function ( $ ) {
    'use strict';

    // Default hide loading image.
    $('#loading-image').hide();

    // Default hide warning icon
    $('#font-warning').hide();

    // Default hide success icon.
    $('#success').hide();

    // Default hide downloading button.
    $('#wpifw_pdf_invoice_font_downloading').hide();

    // Click on Download button.
    $("#wpifw_pdf_invoice_download_font").on(
        'click', function () {
            // Get Dropdown value.
            var selectFont = $("#wpifw-download-pdf-fonts option:selected").val();

            // Hide download button after click button.
            $('#wpifw_pdf_invoice_download_font').hide();

            // Hide success icon after click button.
            $('#success').hide();

            // Show warning icon
            $('#font-warning').hide();

            // Error Message
            $('#errors').hide();

            // Show downloading button.
            $('#wpifw_pdf_invoice_font_downloading').show();

            // Show loading image when click.
            $('#loading-image').show();

            // console.log(font_url);
            $.ajax(
                {
                    url: wpifw_ajax_obj_font.wpifw_ajax_font_url,
                    type:'post',
                    dataType: 'json',
                    data:{
                        action: 'woo_invoice_font_download_ajax', selectFont:selectFont,
                        _ajax_nonce: wpifw_ajax_obj_font.nonce,
                    },
                    success:function (data) {
                         console.log(data);
                        $('#success').html('<span class="dashicons dashicons-yes"></span>');

                        // Hide Loading Image
                        $('#loading-image').hide();

                        // Show success icon
                        $('#success').show();

                        // Show download button
                        $('#wpifw_pdf_invoice_download_font').show();

                        // Hide downloading button
                        $('#wpifw_pdf_invoice_font_downloading').hide();

                    },
                    error:function (error) {
                         console.log(error);
                        $('#errors').show().html('Something went wrong please try again');

                        // Hide Loading Image
                        $('#loading-image').hide();

                        // Show download button
                        $('#wpifw_pdf_invoice_download_font').show();

                        // Hide downloading button
                        $('#wpifw_pdf_invoice_font_downloading').hide();

                        // Show warning icon
                        $('#font-warning').show();
                    }
                }
            )
        }
    )
})(jQuery);