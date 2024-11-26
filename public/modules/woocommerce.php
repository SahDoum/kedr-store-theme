<?php
/**
 * WooCommerce
 *
 * @package kedr-theme
 * @since 2.0
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

class Kedr_Modules_WooCommerce {
    /**
     * Default post type with project taxonomy
     *
     * @access  public
     * @var     array
     */
    public static $post_type = array( 'product' );

    /**
     * Use this method instead of constructor to avoid setting multiple hooks
     */
    public static function load_module() {
        // Здесь можно захукать шаблоны
        // Или настроить свой
    }
}


/**
 * Load current module environment
 */
Kedr_Modules_WooCommerce::load_module();
