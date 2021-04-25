


    // mobile menu responsive
    $( function(e) {
        $(document).on('click','.header-bar',function(){
            $(".mobile-menu-area").addClass("m-menu-zero");
            $(".header-bar").addClass("m-menu-bar");
        });

        $(document).on('click','.m-menu-bar',function(){
            $(".mobile-menu-area").removeClass("m-menu-zero");
            $(".m-menu-bar").removeClass("m-menu-bar");
        });

        $('.mobile-menu-area .m-menu>li>a').on('click', function(e) {
            var element = $(this).parent('li');
              if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(1000,"swing");
            }
            else {
                element.addClass('open');
                element.children('ul').slideDown(1000,"swing");
                element.siblings('li').children('ul').slideUp(1000,"swing");
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(1000,"swing");
            }
        }); 

        // drop down menu width overflow problem fix

        $('.submenu').parent().hover(function() {
            var menu = $(this).find("ul");
            var menupos = $(menu).offset();

            if (menupos.left + menu.width() > $(window).width()) {
                var newpos = -$(menu).width();
                menu.css({ left: newpos });    
            }
        });

        $(".main-menu>li>.submenu").parent("li").children("a").addClass("dd-icon-down");
        $(".main-menu>li>.submenu .submenu").parent("li").children("a").addClass("dd-icon-right");

        $(".cata-submenu>li>.cata-submenu").parent("li").children("a").addClass("dd-icon-right");
        $(".cata-submenu>li>.cata-submenu .cata-submenu").parent("li").children("a").addClass("dd-icon-right");

    }); 

    var fixed_top = $(".header-catagori>.cata-submenu");
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 200) {
                fixed_top.addClass("cata-fixed").css({'transform':'scaleY(0)','transition':'all .5s ease','transform-origin':'top'});
            } else {
                fixed_top.removeClass("cata-fixed").css({'transform':'scaleY(1)','transition':'all .5s ease','transform-origin':'top'});
            }
    });

    $( function(e) {
        $('.header-catagori').hover( function(e) {
            if ($(this).scrollTop() > 200) {
                $('.header-catagori').toggleClass('over')
                fixed_top.addClass(".cata-submenu.cata-fixed").css({'transform':'scaleY(0)','transition':'all .5s ease','transform-origin':'top'});
            } else {
                $('.header-catagori').toggleClass('over')
                fixed_top.removeClass(".cata-submenu.cata-fixed").css({'transform':'scaleY(1)','transition':'all .5s ease','transform-origin':'top'});
            }
        });
    });



    (function($) {

        var fixed_top = $(".primary-menu");
            $(window).on('scroll', function () {
            if ($(this).scrollTop() > 80) {
                fixed_top.addClass("menu-fixed animated fadeInDown");
                fixed_top.removeClass("slideInUp");
                $('body').addClass("body-padding");
            } else {
                fixed_top.removeClass("menu-fixed fadeInDown");
                fixed_top.addClass("slideInUp"); 
                $('body').removeClass("body-padding");
            }
    });

    // lightcase 

    jQuery(document).ready(function($) {
        $('a[data-rel^=lightcase]').lightcase();
    });

    // scroll up start here

    $(document).ready(function(){
        //Check to see if the window is top if not then display button
        $(window).scroll(function(){
            if ($(this).scrollTop() > 800) {
                $('.scrollToTop').css({'bottom':'10%', 'opacity':'1','transition':'all .5s ease'});
            } else {
                $('.scrollToTop').css({'bottom':'-30%', 'opacity':'0','transition':'all .5s ease'})
            }
        });

        //Click event to scroll to top
        $('.scrollToTop').click(function(){
            $('html, body').animate({scrollTop : 0},500);
            return false;
        });

    });


    // bannar slider initial
    $( function(e) {
        var swiper = new Swiper('.banner-slider',{
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: '.banner-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            loop: true,
        });
    });

    // bannar slider initial
    $( function(e) {
        var swiper = new Swiper('.sponser-slider',{
            slidesPerView: 5,
            spaceBetween: 10,
            navigation: {
                nextEl: '.sponser-slider-btn-next',
                prevEl: '.sponser-slider-btn-prev',
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 5,
                    spaceBetween: 10
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 10
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 10
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
            },
            loop: true,
        });
    });

    // feture-product-slider
    $( function(e) {
        var swiper = new Swiper('.feture-product-slider',{
            slidesPerView: 5,
            spaceBetween: 0,
            navigation: {
                nextEl: '.product-slider-btn-next',
                prevEl: '.product-slider-btn-prev',
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            breakpoints: {
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 0
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 0
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
            },
            loop: true,
        });
    });


    $( function(e) {
        $('.popx').on('click', function(e) {
            $('.banner-pbox').toggleClass('close-popb')
        });
    });


})(jQuery);