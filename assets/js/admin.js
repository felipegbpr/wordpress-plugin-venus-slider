(function ($)  {
    "use strict";

    let frame,
        _this = $('#venus_slider_gallery_btn'),
        images = _this.data('ids'),
        selection = loadImages(images);

    _this.on('click', function(e) {
        e.preventDefault();
        let options = {
            title: _this.data('create'),
            state: 'gallery-edit',
            frame: 'post',
            selection: selection
        };

        if ( frame || selection ) {
            options['title'] = _this.data('edit');
        }

        frame = wp.media(options).open();

        // Tweak Views
        frame.menu.get('view').unset('cancel');
        frame.menu.get('view').unset('separateCancel');
        frame.menu.get('view').get('gallery-edit').el.innerHTML = _this.data('edit');
        frame.content.get('view').sidebar.unset('gallery'); // Hide Gallery Settings in sidebar

        // When editing gallery
        overrideGalleryInsert();
        frame.on('toolbar:render:gallery-edit', function() {
            overrideGalleryInsert();
        });

        frame.on('content:render:browse', function(browser) {
            if (!browser) return;
            // Hide Gallery Settings in sidebar
            browser.sidebar.on('ready', function () {
                browser.sidebar.unset('gallery');
            });
            // Hide filter/search as they don't work
            browser.toolbar.on('ready', function () {
                if (browser.toolbar.controller._state === 'gallery-library') {
                    browser.toolbar.$el.hide();
                }
            });
        });

        // All images removed
        frame.state().get('library').on('remove', function () {
            let models = frame.state().get('library');
            if (models.length === 0) {
                selection = false;
                $.post(ajaxurl, {
                    ids: '',
                    action: 'venus_slider_save_images',
                    post_id: _this.data('id')
                });
            }
        });

        function overrideGalleryInsert() {
            frame.toolbar.get('view').set({
                insert: {
                    style: 'primary',
                    text: _this.data('save'),
                    click: function() {
                        let models = frame.state().get('library'),
                        ids = '';

                        models.each(function (attachment) {
                            ids += attachment.id + ',';
                        });

                        this.el.innerHTML = _this.data('progress');

                        $.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                ids: ids,
                                action: 'venus_slider_save_images',
                                post_id: _this.data('id')
                            },
                            success: function () {
                                selection = loadImages(ids);
                                $('#_venus_slider_images_ids').val(ids);
                                frame.close();
                            },
                            dataType: 'html'
                        }).done(function (data) {
                            $('.venus_slider_gallery_list').html(data);
                        });
                    }
                }
            });
        }

    });    

    function loadImages(images) {
        if (images) {
            let shortcode = new wp.shortcode({
                tag: 'gallery',
                attrs: {ids: images},
                type: 'single'
            });

            let attachments = wp.media.gallery.attachments(shortcode);

            let selection = new wp.media.model.Selection(attachments.models, {
                props: attachments.props.toJSON(),
                multiple: true
            });

            selection.gallery = attachments.gallery;

            selection.more().done(function () {
               // Break ties with the query.
               selection.props.set({query: false});
               selection.unmirror();
               selection.props.unset('orderby');
            });

            return selection;
        }

        return false;
    }

})(jQuery);

/**
 * Venus Slider Gallery from URL
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
    modal.on('click', '.venus_slider-close', function(e) {
        e.preventDefault();
        modal.css("block", "none");
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

(function ($) {
    'use strict';

    let slide_type = $('#_venus_slider_slide_type'),
        section_images_settings = $('#section_images_settings'),
        section_url_images_settings = $('#section_url_images_settings'),
        section_images_general_settings = $('#section_images_general_settings'),
        section_post_query = $('#section_post_query'),
        section_video_settings = $('#section_video_settings'),
        section_product_query = $('#section_product_query'),
        // Slide Type -- Post
        _post_query_type = $('#_post_query_type'),
        _post_date_after = $('#field-_post_date_after'),
        _post_date_before = $('#field-_post_date_before'),
        _post_categories = $('#field-_post_categories'),
        _post_tags = $('#field-_post_tags'),
        _post_in = $('#field-_post_in'),
        _posts_per_page = $('#field-_posts_per_page'),
        // Slide Type -- Product
        _product_query_type = $('#_product_query_type'),
        _product_query = $('#field-_product_query'),
        _product_categories = $('#field-_product_categories'),
        _product_tags = $('#field-_product_tags'),
        _product_in = $('#field-_product_in'),
        _product_per_page = $('#field-_products_per_page');
    
    // Slide Type
    slide_type.on('change', function() {
        section_images_settings.hide('fast');  
        section_url_images_settings.hide('fast');  
        section_images_general_settings.hide('fast');  
        section_post_query.hide('fast');  
        section_images_settings.hide('fast');  
        section_video_settings.hide('fast');  
        section_product_query.hide('fast');  

        if (this.value === 'images-carousel') {
            section_images_settings.slideDown();
            section_images_general_settings.slideDown();
        }

        if (this.value === 'images-carousel-url') {
            section_url_images_settings.slideDown();
            section_images_general_settings.slideDown();
        }

        if (this.value === 'post-carousel') {
            section_post_query.slideDown();
        }

        if (this.value === 'video-carousel') {
            section_video_settings.slideDown();
        }

        if (this.value === 'product-carousel') {
            section_product_query.slideDown();
        }
    });   
    
    // Slide Type -- Post Carousel
    if (slide_type.val() === 'post-carousel') {
        let _postQueryType = _post_query_type.val();
        if (_postQueryType === 'date_range') {
            _post_date_after.show();
            _post_date_before.show();
        }
        
        if (_postQueryType === 'post_categories') {
            _post_categories.show();
        }
       
        if (_postQueryType === 'post_tags') {
            _post_tags.show();
        }
        
        if (_postQueryType === 'specific_posts') {
            _post_in.show();
            _posts_per_page.hide();
        }
    }

    _post_query_type.on('change', function () {

        _post_date_after.hide('fast');
        _post_date_before.hide('fast');
        _post_categories.hide('fast');
        _post_tags.hide('fast');
        _post_in.hide('fast');
        _posts_per_page.show('fast');

        if (this.value === 'date_range') {
            _post_date_after.slideDown();
            _post_date_before.slideDown();
        }
        
        if (this.value === 'post_categories') {
            _post_categories.slideDown();
        }
        
        if (this.value === 'post_tags') {
            _post_tags.slideDown();
        }
        
        if (this.value === 'specific_posts') {
            _post_in.slideDown();
            _posts_per_page.hide('fast');
        }
    });

    // Slide Type -- Product Carousel
    if (slide_type.val() === 'product-carousel') {
        let _productQueryType = _product_query_type.val();
        if (_productQueryType === 'query_product') {
            _product_query.show();
        }
        
        if (_productQueryType === 'product_categories') {
            _product_categories.show();
        } 

        if (_productQueryType === 'product_tags') {
            _product_tags.show();
        } 

        if (_productQueryType === 'specific_products') {
            _product_in.show();
        } 
    }

    _product_query_type.on('change', function () {

        _product_query.hide('fast');
        _product_categories.hide('fast');
        _product_tags.hide('fast');
        _product_in.hide('fast');
        _product_per_page.hide('fast');

        if (this.value === 'query_porduct') {
            _product_query.slideDown();
        }
        if (this.value === 'product_categories') {
            _product_categories.slideDown();
        }
        if (this.value === 'product_tags') {
            _product_tags.slideDown();
        }
        if (this.value === 'specific_products') {
            _product_in.slideDown();
            _products_per_page.hide('fast');
        }
    });     
})(jQuery);

(function ($) {
    'use strict';

    // Select2
    $("select.select2").each(function() {
        $(this).select2();
    });

    // Accordion
    $(".shapla-toggle").each(function () {
        if ($(this).attr('data-id') === 'closed') {
            $(this).accordion({
                header: '.shapla-toggle-title',
                collapsible: true,
                heightStyle: "content",
                active: false
            });
        } else {
            $(this).accordion({
                header: '.shapla-toggle-title',
                collapsible: true,
                heightStyle: 'content'
            });
        }
    });

    // Initializing jQuery UI Datepicker
    $('.datapicker').each(function () {
        $(this).datepicker({
            dateFormat: 'MM dd, yy',
            changeMonth: true,
            changeYear: true,
            onClose: function(selectedDate) {
                $(this).datepicker('option', 'minDate', selectedDate);
            }
        });
    });

    // Initializing WP Color Picker
    $('.colorpicker').each(function () {
        $(this).wpColorPicker();
    });

})(jQuery);

