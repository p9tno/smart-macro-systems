var app = {
    pageScroll: '',
    lgWidth: 1200,
    mdWidth: 992,
    smWidth: 768,
    resized: false,
    iOS: function () {
        return navigator.userAgent.match( /iPhone|iPad|iPod/i );
    },
    touchDevice: function () {
        return navigator.userAgent.match( /iPhone|iPad|iPod|Android|BlackBerry|Opera Mini|IEMobile/i );
    }
};

function isLgWidth() {
    return $( window ).width() >= app.lgWidth;
} // >= 1200
function isMdWidth() {
    return $( window ).width() >= app.mdWidth && $( window ).width() < app.lgWidth;
} //  >= 992 && < 1200
function isSmWidth() {
    return $( window ).width() >= app.smWidth && $( window ).width() < app.mdWidth;
} // >= 768 && < 992
function isXsWidth() {
    return $( window ).width() < app.smWidth;
} // < 768
function isIOS() {
    return app.iOS();
} // for iPhone iPad iPod
function isTouch() {
    return app.touchDevice();
} // for touch device


window.onload = function () {
    console.log('onload');
    function preloader() {
        $(()=>{

            setTimeout( () => {
                let p = $('#loader');
                p.addClass('hide');

                setTimeout( () => {
                    p.remove()
                },1000);

            },1000);
        });
    }
    preloader();
}

$(document).ready(function() {


    function scrollPage () {
        $(".toTop").on("click","a", function (event) {
            event.preventDefault();
            let id  = $(this).attr('href');
            let top = $(id).offset().top;
            $('body,html').animate({scrollTop: top}, 1500);
        });

        $(window).scroll(function(){
            if($(window).scrollTop()>500){
                $('.toTop').addClass('show');
            }else{
                $('.toTop').removeClass('show');
            }
        });
    }
    scrollPage();

;

    function openNav() {
        $('.header__toggle').click(function(event) {
            // console.log('Показ меню');
            $('.navbar').toggleClass('active');
            $('.header__toggle').toggleClass('active');
            $( 'body' ).toggleClass( 'nav-open' );
        });
    };
    openNav();




    function initAOS () {
        // https://github.com/michalsnik/aos
        AOS.init({
            disable: 'mobile',
            // anchorPlacement: 'bottom-bottom',
            duration: 1000, // values from 0 to 3000, with step 50ms
            // offset: 20,
            // once: true,
        });

        AOS.init({
            disable: function () {
                var maxWidth = 768;
                return window.innerWidth < maxWidth;
            }
        });

    }
    initAOS ();

    function scroolTo() {
        $(".menu-item > a").on("click", function (event) {
            event.preventDefault();
            $(".menu-item").removeClass('current-menu-item');
            $(this).parent().addClass('current-menu-item');
            let id  = $(this).attr('href');
            let top = $(id).offset().top;
            $('body,html').animate({scrollTop: top}, 1500);

            $('.navbar').removeClass('active');
            $('.header__toggle').removeClass('active');
            $( 'body' ).removeClass( 'nav-open' );
        });
    };
    scroolTo();

})
