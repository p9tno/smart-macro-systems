<!-- begin head -->
<section id="head-<?php the_ID(); ?>" <?php post_class('head section'); ?>>

<?php
// echo "<h1>";
// echo get_post_type(); 
// echo "</h1>"

?>

    <?php if (is_archive()) { ?>
        <div class="container_center content mt">
            <div class="head__caption">
                <h1 class="section__title"><?php the_archive_title(); ?></h1>
                <div class="head__desc"><?php the_archive_description(); ?></div>
            </div>
        </div>
    <?php } else { ?>
        
        <?php if (has_post_thumbnail()) { ?>
            <div class="section__wrap">
                <div class="head__content">
                    <h1 class="section__title "><?php the_title(); ?></h1>
                </div>
                <div class="head__img img br"> <?php the_post_thumbnail(); ?></div>
            </div>
        <?php } else { ?>
            <div class="container_center content mt">
                <h1 class="section__title"><?php the_title(); ?></h1>
            </div>
        <?php } ?>

    <?php } ?>


</section>
<!-- end head -->



