/**
 * Carousel Slider Gallery from URL
 */
(function ($) {
    'use strict';

    let body = $('body'),
        modal = $('#VenusSliderModal'),
        modalOpenBtn = $('#_images_urls_btn'),
        template = $('#venusSliderGalleryUrlTemplate').html();

    // URL Images Model
    modalOpenBtn.on('click', function (e) {
        e.preventDefault();
        modal.css("display", "block");
        $("body").addClass("overflowHidden");
    });
    modal.on('click', '.venus_slider-close', function (e) {
        e.preventDefault();
        modal.css("display", "none");
        $("body").removeClass("overflowHidden");
    });

    let venusSliderBodyHeight = $(window).height() - (38 + 48 + 32 + 30);
    $('.venus_slider-modal-body').css('height', venusSliderBodyHeight + 'px');

    // Append new row
    body.on('click', '.add_row', function () {
        $(this).closest('.venus_slider-fields').after(template);
    });

    // Delete current row
    body.on('click', '.delete_row', function () {
        $(this).closest('.venus_slider-fields').remove();
    });

    // Make fields sortable
    $('#venus_slider_form').sortable();

})(jQuery);