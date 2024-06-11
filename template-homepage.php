<?php
/**
 * Template name: Home Page Template
 */
?>

<?php get_header(); ?>

<?php // include 'sections.php'; ?>

<?php // echo get_template_directory_uri() . '/assets.' ?>




<?php
    // $no_img_url = get_template_directory_uri() . '/assets/img/no_img.webp' ;
    // $image_id = get_field('test_img');
    // $size = 'full'; // (thumbnail, medium, full, vertical, horizon)

    // if( $image_id ) {
    //     $img_url = wp_get_attachment_image_url($image_id, $size);
    // } else {
    //     $img_url = $no_img_url;
    // }

?>


<?php if ( is_page_template(['template-homepage.php']) ) {} ?>
       

<?php

get_template_part( 'template-parts/sections/section', 'firstscreen' );
get_template_part( 'template-parts/sections/section', 'preview' );
get_template_part( 'template-parts/sections/section', 'work' );
get_template_part( 'template-parts/sections/section', 'homeExamples' );
get_template_part( 'template-parts/sections/section', 'ofices' );
get_template_part( 'template-parts/sections/section', 'oficesExamples' );
get_template_part( 'template-parts/sections/section', 'buildings' );
get_template_part( 'template-parts/sections/section', 'macro' );
get_template_part( 'template-parts/sections/section', 'macroFunctions' );
get_template_part( 'template-parts/sections/section', 'smartHome' );
get_template_part( 'template-parts/sections/section', 'securityExample' );
get_template_part( 'template-parts/sections/section', 'benefits' );


?>

<?php if (SCF::get_option_meta('my-theme-settings', 'test')) { ?>
    <?php echo SCF::get_option_meta('my-theme-settings', 'test'); ?>
<?php } ?>


<?php if (SCF::get( 'test' )) { ?>
    <?php echo SCF::get( 'test' ); ?>
<?php } ?>

<?php if (SCF::get( 'test' )) { ?>
<?php } ?>
<?php echo SCF::get( 'test' ); ?>

<!-- each -->
<?php $row = SCF::get('test');
if ($row) { ?>
    <?php foreach ($row as $col) {  ?>
        <?php echo $col['test']; ?>
    <?php } ?>
<?php }; ?>

<!-- geti -->
<?php echo wp_get_attachment_image(SCF::get( 'test' ), 'full'); ?>
    

<!-- getiu -->
<?php echo wp_get_attachment_url(SCF::get( 'test' )); ?>

<!-- item -->
<?php // echo $item[''] ?>

<!-- eachimg -->
<?php // echo wp_get_attachment_image($item['tetst']) ?>
<?php // echo wp_get_attachment_url($item['test']) ?>


<?php get_footer(); ?>