/**
 * Created by Martin on 04.08.14.
 */
jQuery(document).ready(function ($) {

    $('#filterProducttitles').keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.product-grid-container .product-grid .grid-item').hide();
        $('.product-grid-container .product-grid .grid-item').filter(function () {
            return rex.test($(this).text());
        }).show();
    });
    
});