<?php
/**
 * News manager
 * Manage news category
 *
 * @package kedr-theme
 * @since 2.0
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

class Kedr_News_Filters {
    /**
     * Unique slug using for news category url
     *
     * @access  public
     * @var     string
     */
    public static $slug = 'news';

    /**
     * Init function instead of constructor
     */
    public static function load_module() {
        add_filter( 'archive_template', array( __CLASS__, 'include_archive' ) );
        add_filter( 'single_template', array( __CLASS__, 'include_single' ) );
        add_action( 'pre_get_posts', array( __CLASS__, 'update_count' ) );
        add_action( 'pre_get_posts', array( __CLASS__, 'remove_from_authors' ) );
    }

    /**
     * Include custom archive template for news
     */
    public static function include_archive( $template ) {
        if ( ! is_feed() && is_category( self::$slug ) ) {
            $new_template = locate_template( array( 'templates/archive-news.php' ) );

            if ( ! empty( $new_template ) ) {
                return $new_template;
            }
        }

        return $template;
    }

    /**
     * Include custom single template for news
     */
    public static function include_single( $template ) {
        if ( ! is_feed() && in_category( self::$slug ) ) {
            $new_template = locate_template( array( 'templates/single-news.php' ) );

            if ( ! empty( $new_template ) ) {
                return $new_template;
            }
        }

        return $template;
    }

    /**
     * Change posts_per_page for news category archive template
     */
    public static function update_count( $query ) {
        if ( $query->is_main_query() && get_query_var( 'category_name' ) === self::$slug ) {
            $query->set( 'posts_per_page', 18 );
        }
    }

    /**
     * Remove news from authors archive
     */
    public static function remove_from_authors( $query ) {
        if ( $query->is_main_query() && $query->is_author() ) {

            $query->tax_query->queries[] = array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => self::$slug,
                'operator' => 'NOT IN',
            );

            $query->query_vars['tax_query'] = $query->tax_query->queries; // phpcs:ignore
        }
    }
}


/**
 * Load current module environment
 */
Kedr_News_Filters::load_module();