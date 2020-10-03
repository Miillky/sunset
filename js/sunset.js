/**
 * @package sunsettheme
 * Custom Sunset Script
 */
jQuery(document).ready(function($){

    var carousel = '.sunset-carousel-thumb';

    function sunset_get_bs_thumbs(carousel){
        var activeThumb = $('.item.active');

        $(carousel).find('.carousel-control.left')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('prev-image') + ')'});

        $(carousel).find('.carousel-control.right')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('next-image') + ')'});
    }

   sunset_get_bs_thumbs(carousel)

    $(carousel).on('slid.bs.carousel', function(){
        sunset_get_bs_thumbs(this);
    });

})