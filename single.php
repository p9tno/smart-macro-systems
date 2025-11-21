<?php
get_header();
?>
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part('template-parts/sections/section', 'head');
		get_template_part('template-parts/sections/section', 'content');
		get_template_part('template-parts/sections/section', 'post-navigation');
	endwhile;
	?>
<?php

get_footer();
