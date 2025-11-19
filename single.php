<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sms
 */

get_header();
?>

	

		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part('template-parts/sections/section', 'head');

	
			get_template_part('template-parts/sections/section', 'content');
			get_template_part('template-parts/sections/section', 'post-navigation');


		

	

		endwhile; // End of the loop.
		?>


<?php
// get_sidebar();
get_footer();
