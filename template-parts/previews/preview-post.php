<?php
$post = get_post( get_the_ID() );
$post_ID = $post->ID;
// $category = get_the_terms($post_ID, 'blog-cat');

if ( has_post_thumbnail() ) {
    $img = get_the_post_thumbnail( get_the_ID(), 'full', array( 'loading' => 'lazy' ) );
} else {
    $img_url = get_template_directory_uri() . '/assets/img/no_img.png';
    $img = '<img src="' . $img_url . '" alt="' . get_the_title() . '" loading="lazy" />';
}

?>


<div class="archive-roll__item">
    <div class="archive-roll__img img br"><?php echo $img; ?></div>
    <div class="archive-roll__bottom">
        <a href="<?php the_permalink(); ?>" class="archive-roll__title"><?php the_title(); ?></a>
        <div class="archive-roll__text"><?php the_excerpt_max_charlength(150); ?></div>
    </div>
</div>
