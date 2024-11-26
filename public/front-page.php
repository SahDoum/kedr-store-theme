<?php
/**
 * Template for showing site front-page
 *
 * @package kedr-theme
 * @since 2.0
 */

get_header();

// В этом файле описывается главная. Ниже -- план


// ask categs
// for every cat get products
// loop this products (template)

$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 12,
);
$loop = new WP_Query( $args );

// loop query separated by categories

if ( $loop->have_posts() ) {



    while ( $loop->have_posts() ) : // loop for every category
        $loop->the_post();
        // print_r( $post );
        wc_get_template_part( 'content', 'product' ); // rewrite own template or hook
    endwhile;
} else {
    echo __( 'No products found' );
}
wp_reset_postdata();

get_footer();
