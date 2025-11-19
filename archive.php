<?php
get_header();
?>

	<?php if ( have_posts() ) : ?>

		<?php get_template_part('template-parts/sections/section', 'head'); ?>

		<!-- begin archive-roll -->
		<section id="archive-roll" class="archive-roll section">
			<div class="container_center">
				<div class="archive-roll__content">
					<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/previews/preview', get_post_type() );
						endwhile;
					?>
				</div>
			</div>
		</section>
		<!-- end archive-roll -->

		<?php

		the_paginate();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	
	?>

<?php

get_footer();
