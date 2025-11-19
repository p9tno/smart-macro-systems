<?php 
// Кастомизированная навигация с дополнительной логикой
$prev_post = get_previous_post();
$next_post = get_next_post();

?>

<?php 
if ($prev_post || $next_post) { ?>
    <!-- begin post-navigation -->
    <section id="post-navigation" class="post-navigation-sections section">
        <div class="container_center">
        <?php

        echo '<nav class="navigation posts-navigation" role="navigation">';

            echo '<div class="nav-links">';
            
            if ( $prev_post ) {
                echo '<div class="nav-previous">';
                    echo '<a class="btn" href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" rel="prev">';
                        echo '<span class="nav-arrow">←</span>';
                        echo '<div class="nav-content">';
                            echo '<span class="nav-title">' . esc_html( $prev_post->post_title ) . '</span>';
                        echo '</div>';
                    echo '</a>';
                echo '</div>';
            }
            
            if ( $next_post ) {
                echo '<div class="nav-next">';
                    echo '<a class="btn" href="' . esc_url( get_permalink( $next_post->ID ) ) . '" rel="next">';
                        echo '<div class="nav-content">';
                            echo '<span class="nav-title">' . esc_html( $next_post->post_title ) . '</span>';
                        echo '</div>';
                        echo '<span class="nav-arrow">→</span>';
                    echo '</a>';
                echo '</div>';
            }
            
            echo '</div>';

        echo '</nav>';
      
        ?>
        </div>
    </section>
    <!-- end post-navigation -->
<?php }
