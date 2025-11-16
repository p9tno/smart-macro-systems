<!-- begin content -->
<section id="content-<?php the_ID(); ?>" <?php post_class('content section'); ?>>
	<div class="container_center">
		<div class="content__wrap">
			<h1 class="section__title"><?php the_title(); ?></h1>

			<?php
				if (has_post_thumbnail()) {
					the_post_thumbnail();
				}
			?>
			

			<?php the_content(); ?>

		</div>
	</div>
</section>
<!-- end content -->

