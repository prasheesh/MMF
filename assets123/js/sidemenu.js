(function($){

    'use strict';
    // Active menu for sidemenu dashboard
    $('.main-menu li a').each(function(){
        let PagesUrl = window.location.href.split(/[?#]/)[0];
        if(this.href == PagesUrl){
            $(this).addClass("active");
        }
    });

    // Active menu for horizontal menu site
    $('.navbar ul li a').each(function(){
        let PagesUrl = window.location.href.split(/[?#]/)[0];
        if(PagesUrl.endsWith('/')){
            if(PagesUrl.slice(0,-1) == this.href)
            {
                $(this).addClass("active");
            }
        }else{
            if(this.href == PagesUrl){
                $(this).addClass("active");
            }
        }
    });
})(jQuery);
