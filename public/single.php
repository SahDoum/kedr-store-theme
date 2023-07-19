<?php
/**
 * Template for display single post
 *
 * @package kedr-theme
 * @since 2.0
 */

get_header(); ?>

<section class="content">
    <?php
    while ( have_posts() ) :
        the_post();

        // The function get_the_partial is defined in template-tags.php
        get_template_part( 'templates/content', get_post_format() );
    endwhile;

    if ( is_active_sidebar( 'kedr-bottom' ) ) :
        dynamic_sidebar( 'kedr-bottom' );
    endif;
    ?>
</section>

<?php
get_footer();