			<?php 
			// Проверяем все необходимые плагины
			$required_plugins = theme_get_required_plugins();
			if (theme_check_required_plugins($required_plugins)) { ?>
				</main>
				<!-- end main -->

				<?php get_template_part( 'template-parts/content', 'footer' ); ?>
				<?php get_template_part( 'template-parts/parts/part', 'top' ); ?>

			</div>
			<!-- end wrapper -->

			<?php get_template_part( 'template-parts/modals/modal', 'wpcf7-info' ); ?>

			<?php } ?>			
			
		<?php wp_footer(); ?>

	</body>
</html>
