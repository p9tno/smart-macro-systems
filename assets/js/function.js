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
    // console.log('ready');

    function stikyMenu() {
        const $headerSticked = $('.header_sticked');
        
        if (!$headerSticked.length) return;
        
        const headerTop = $headerSticked.offset().top + $headerSticked.innerHeight();        
        let currentTop = $(window).scrollTop();
        
        function setNavbarPosition() {
            currentTop = $(window).scrollTop();
            $headerSticked.toggleClass('stiky', currentTop > headerTop);
        }
        
        setNavbarPosition();
        $(window).scroll(setNavbarPosition);
    }

    stikyMenu();
    
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

    function openNav() {
        $('.header__toggle').click(function(event) {
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
            duration: 1000,
        });

        AOS.init({
            disable: function () {
                var maxWidth = 768;
                return window.innerWidth < maxWidth;
            }
        });

    }
    initAOS ();

    function showModal() {
        $('.show_modal_js').on('click', function (e) {
            e.preventDefault();
            let id = $(this).attr('href');       
            $(id).modal('show');
        });

        $('.modal').on('show.bs.modal', () => {
            let openedModal = $('.modal');
            if (openedModal.length > 0) {
                openedModal.modal('hide');
            }
        });

        // $('.modal').on('hide.bs.modal', () => {});
    }
    showModal();


    function initContactFormModal() {
        let modal = $('#wpcf7-info');
        let message = modal.find('.wpcf7-info__message');
        
        modal.on('hidden.bs.modal', function (e) {
            message.html('');
        });
        
        // Общая функция для обработки событий
        function handleFormEvent(event) {
  
            // Даем время для обновления DOM
            setTimeout(() => {
                let responseText = $('.wpcf7-response-output').text();
                console.log('Найденный текст:', responseText);
                
                // Если текст пустой, используем fallback
                if (!responseText) {
                    switch(event.type) {
                        case 'wpcf7mailsent':
                            responseText = 'Сообщение успешно отправлено!';
                            break;
                        case 'wpcf7invalid':
                            responseText = 'Пожалуйста, исправьте ошибки в форме.';
                            break;
                        case 'wpcf7mailfailed':
                            responseText = 'Произошла ошибка при отправке сообщения.';
                            break;
                        default:
                            responseText = 'Сообщение отправлено.';
                    }
                }
                
                message.html(responseText);
                modal.modal('show');
            }, 300);
        }
        
        // Назначаем обработчики
        $(document).on('wpcf7mailsent', handleFormEvent);
        // $(document).on('wpcf7invalid', handleFormEvent);
        $(document).on('wpcf7mailfailed', handleFormEvent);
    }
    // initContactFormModal();

    function showPrivacyPopup () {
        const  confirm = localStorage.getItem('confirm');
        const box = document.querySelector('.privacyBox');
        if (confirm) { 
            box.classList.add('hidden');
        } else {
            box.classList.remove('hidden');
        }

        const close = document.querySelector('.privacyBox__close');
        close.addEventListener('click', function() {
            localStorage.setItem('confirm', 'true');
            box.classList.add('hidden');
        });
    }
    showPrivacyPopup();

})
