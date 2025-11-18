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
    console.log('ready');
    
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
    // scroolTo();

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
    // showModal();


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
    initContactFormModal();
})

jQuery(document).ready(function($) {
    
    // Функция инициализации меню
    function initMenu() {
        // Только для мобильных
        if ($(window).width() < 768) {
            initMobileMenu();
        }
    }
    
    // Мобильное меню
    function initMobileMenu() {
        // Добавляем кнопки переключения если их нет
        $('.menu-item-has-children').each(function() {
            const $this = $(this);
            const $link = $this.children('a');
            
            if (!$link.next('.menu-toggle').length) {
                $link.after('<button class="menu-toggle">+</button>');
            }
        });
        
        // Обработчик клика по кнопке
        $(document).off('click', '.menu-toggle').on('click', '.menu-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const $this = $(this);
            const $parentItem = $this.closest('.menu-item-has-children');
            const $subMenu = $parentItem.find('.sub-menu').first();
            
            // Закрываем другие подменю на том же уровне
            $parentItem.siblings().find('.sub-menu').slideUp(300).removeClass('menu-open');
            $parentItem.siblings().find('.menu-toggle').text('+');
            
            // Переключаем текущее подменю
            $subMenu.slideToggle(300).toggleClass('menu-open');
            $this.text($this.text() === '+' ? '-' : '+');
        });
        
        // Закрытие подменю при клике вне меню
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.menu').length) {
                $('.sub-menu').slideUp(300).removeClass('menu-open');
                $('.menu-toggle').text('+');
            }
        });
    }
    
    // Десктопное меню - сбрасываем мобильные стили
    function resetMobileMenu() {
        $('.menu-toggle').remove();
        $('.sub-menu')
            .removeClass('menu-open')
            .css('display', '');
    }
    
    // Проверка при загрузке
    if ($(window).width() < 768) {
        initMobileMenu();
    }
    
    // Проверка при изменении размера
    $(window).on('resize', function() {
        if ($(window).width() < 768) {
            initMobileMenu();
        } else {
            resetMobileMenu();
        }
    });
    
});
