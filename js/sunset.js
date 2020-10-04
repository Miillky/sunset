/**
 * @package sunsettheme
 * Custom Sunset Script
 */
jQuery(document).ready(function($){

    var carousels = '.sunset-carousel-thumb';

    function sunset_get_bs_thumbs(carousel){

        var activeThumb = $(carousel).find('.item.active');

        $(carousel).find('.carousel-control.left')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('prev-image') + ')'});
        $(carousel).find('.carousel-control.right')
            .find('.thumbnail-container')
            .css({'background-image' : 'url(' + activeThumb.data('next-image') + ')'});
    }

    $(carousels).each(function(index, carousel){
        sunset_get_bs_thumbs(carousel)
    });

    $(carousels).on('slid.bs.carousel', function(){
        sunset_get_bs_thumbs(this);
    });

})