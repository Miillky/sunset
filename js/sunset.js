/**
 * @package sunsettheme
 * Custom Sunset Script
 */
jQuery(document).ready(function($){

    /**
     * Init functions
     */
    revealPosts();

    /**
     * Variable declaration
     */
    var carousels = '.sunset-carousel-thumb';
    var last_scroll = 0;

    /**
     * Carousel
     */
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

    /**
     * Ajax Functions
     */
    $(document).on('click', '.sunset-load-more:not(.loading)', function(){

        var that = $(this);
        var page = that.data('page');
        var newPage = page+1;
        var ajax_url = that.data('url');
        var posts_container =  $('.sunset-posts-container');

        that.addClass('loading').find('.text').slideUp(320);
        that.find('.sunset-icon').addClass('spin');

        $.ajax({
            url: ajax_url,
            type: 'post',
            data: {
                page: page,
                action: 'sunset_load_more'
            },
            error: function(response){
                console.log(response)
            },
            success: function(response){
                that.data('page', newPage);

                setTimeout(function(){

                    posts_container.append(response);
                    that.removeClass('loading').find('.text').slideDown(320);
                    that.find('.sunset-icon').removeClass('spin');

                    $(carousels).each(function(index, carousel){
                        sunset_get_bs_thumbs(carousel)
                    });

                    $(carousels).off('slid.bs.carousel');
                    $(carousels).on('slid.bs.carousel', function(){
                        sunset_get_bs_thumbs(this);
                    });

                    revealPosts();

                }, 2000)
            }
        });
    });

    /**
     * Scroll functions
     */
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();

        if( Math.abs(scroll - last_scroll) > $(window).height() * 0.1 ){
            last_scroll = scroll;

            $('.page-limit').each(function(index){
                if( isVisible($(this)) ){
                    history.replaceState(null, null, $(this).data('page'));
                    return false;
                }
            });
        }

    });

    /**
     * Helper functions
     */
    function revealPosts(){

        var posts = $('article:not(.reveal)');
        var i = 0;

        setInterval(function(){

            if( i >= posts.length )
                return false;

            $(posts[i]).addClass('reveal')
                .find(carousels)
                .carousel();

            i++;

        }, 200);
    }

    function isVisible(element){

        var scroll_pos = $(window).scrollTop();
        var window_height = $(window).height();
        var el_top = $(element).offset().top;
        var el_height = $(element).height();
        var el_bottom = el_top + el_height;

        return (el_bottom - el_height * 0.25 > scroll_pos) && (el_top < (scroll_pos + 0.5 * window_height) );
    }

})