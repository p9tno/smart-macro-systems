<?php
$post = get_post( get_the_ID() );
$post_ID = $post->ID;
$category = get_the_terms($post_ID, 'blog-cat');

if (SCF::get( 'blog_img' )) {
    $img =  wp_get_attachment_image(SCF::get( 'blog_img' ), 'full'); 
} else {
    $img_url = get_template_directory_uri() . '/assets/img/no_img.webp';
    $img = '<img src="'.$img_url.'" alt="image" loading="lazy" />';
}


?>
<!-- begin advice -->
<section class="section section__page" id="page-<?php the_ID(); ?>">
	<div class="container_center">
		<div class="section__head">
			<h1 class="section__title top_title_js" data-aos="fade-up"><?php the_title(); ?></h1>
<!-- 			<div class="advice__info">
				<div class="advice__info_item"><i class="icon_calendar"></i><span><b>Date: </b><?php // the_time('F j, Y'); ?></span></div>
				<div class="advice__info_item"><i class="icon_clock"></i><span><b>Reading Time:</b> <?php // echo est_read_time(); ?> min</span></div>
			</div> -->
		</div>
	</div>

    <div class="container_center">
		  <div class="section__text">
			  <?php the_content(); ?>
		</div>
<!--         <div class="advice__main">
            <div class="advice__sidebar">
                <div class="sidebar sidebarNav"></div>
            </div>
            <div class="advice__content">
                <div class="section__text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div> -->
    </div>

</section>
<!-- end advice -->