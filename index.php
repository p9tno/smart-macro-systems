<?php
get_header();

// Проверяем все необходимые плагины
// $required_plugins = theme_get_required_plugins();
// if (theme_check_required_plugins($required_plugins)) {
//     // Все плагины активны, загружаем контент
//     if ( have_posts() ) :

//         while ( have_posts() ) :
//             the_post();

//             if ( is_front_page() ) :
//                 get_template_part( 'template-parts/content', 'front-page' );
//             else :
//                 get_template_part( 'template-parts/content', get_post_type() );
//             endif;

//         endwhile;

//     else :

//         get_template_part( 'template-parts/content', 'none' );

//     endif;

// } else {
//     // Показываем сообщение о необходимости плагинов
//     get_template_part('template-parts/sections/section', 'plugin-required', array(
//         'required_plugins' => $required_plugins
//     ));
// }

get_template_part('template-parts/sections/section', 'benefits');
// get_template_part('template-parts/sections/section', 'benefits');

get_footer();