<!-- begin homeExamples-->
<section class="homeExamples section" id="homeExamples">
    <div class="section__wrap br">
        <div class="container_center">
            <?php if (SCF::get( 'homeExamples_label' )) { ?>
                <div class="section__label" data-aos="fade-right"><?php echo SCF::get( 'homeExamples_label' ); ?></div>
            <?php } ?>

            <?php if (SCF::get( 'homeExamples_title' )) { ?>
                <h2 class="section__title" data-aos="fade-up"><?php echo SCF::get( 'homeExamples_title' ); ?></h2>
            <?php } ?>

            <div class="homeExamples__grid">
                <?php
                    $post_id = SCF::get( 'homeExamples_relation' );
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'post__in' => $post_id,
                        'orderby'   => 'post__in',
    
                    );
                    $query = new WP_Query($args);
                ?>
        
                <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                    <?php get_template_part( 'template-parts/previews/preview', 'homeExamples' ); ?>
                <?php endwhile; ?>
        
                <?php else : ?>
                    <p>No found</p>
                <?php endif; ?>
        
                <?php wp_reset_postdata(); ?>
                
            </div>

        </div>
    </div>
</section>
<!-- end homeExamples-->