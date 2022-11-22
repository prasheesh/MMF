(function($){

    'use strict';

    // Active Class
    $('.main-menu li a').each(function(){
        let PagesUrl = window.location.href.split(/[?#]/)[0];
        if(this.href == PagesUrl){
            $(this).addClass("active");
        }
    });
})(jQuery);