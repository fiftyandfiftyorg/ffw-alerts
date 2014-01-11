<?php
/**
 * Post Type Functions
 *
 * @package     Fifty Framework Alerts
 * @subpackage  Alerts Post type_url_form_media
 * @copyright   Copyright (c) 2013, Fifty and Fifty
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Registers and sets up the Downloads custom post type
 *
 * @since 1.0
 * @return void
 */
function setup_ffw_alerts_post_types() {
    
    $archives = defined( 'FFW_ALERTS_DISABLE_ARCHIVE' ) && FFW_ALERTS_DISABLE_ARCHIVE ? false : true;
    $slug = defined( 'FFW_ALERTS_SLUG' ) ? FFW_ALERTS_SLUG : 'alerts';
    $rewrite  = defined( 'FFW_ALERTS_DISABLE_REWRITE' ) && FFW_ALERTS_DISABLE_REWRITE ? false : array('slug' => $slug, 'with_front' => false);

    $ffw_alerts_labels =  apply_filters( 'ffw_alerts_labels', array(
        'name'              => '%2$s',
        'singular_name'     => '%1$s',
        'add_new'           => __( 'Add New', 'ffw_alerts' ),
        'add_new_item'      => __( 'Add New %1$s', 'ffw_alerts' ),
        'edit_item'         => __( 'Edit %1$s', 'ffw_alerts' ),
        'new_item'          => __( 'New %1$s', 'ffw_alerts' ),
        'all_items'         => __( '%2$s', 'ffw_alerts' ),
        'view_item'         => __( 'View %1$s', 'ffw_alerts' ),
        'search_items'      => __( 'Search %2$s', 'ffw_alerts' ),
        'not_found'         => __( 'No %2$s found', 'ffw_alerts' ),
        'not_found_in_trash'=> __( 'No %2$s found in Trash', 'ffw_alerts' ),
        'parent_item_colon' => '',
        'menu_name'         => __( '%2$s', 'ffw_alerts' )
    ) );

    foreach ( $ffw_alerts_labels as $key => $value ) {
       $ffw_alerts_labels[ $key ] = sprintf( $value, ffw_alerts_get_label_singular(), ffw_alerts_get_label_plural() );
    }

    $ffw_alerts_args = array(
        'labels'            => $ffw_alerts_labels,
        'public'            => true,
        'publicly_queryable'=> true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'menu_icon'         => 'dashicons-flag',
        'query_var'         => true,
        'rewrite'           => $rewrite,
        'map_meta_cap'      => true,
        'has_archive'       => $archives,
        'show_in_nav_menus' => true,
        'hierarchical'      => false,
        'supports'          => apply_filters( 'ffw_alerts_supports', array( 'title', 'excerpt' ) ),
    );
    register_post_type( 'ffw_alerts', apply_filters( 'ffw_alerts_post_type_args', $ffw_alerts_args ) );
    
}
add_action( 'init', 'setup_ffw_alerts_post_types', 1 );

/**
 * Get Default Labels
 *
 * @since 1.0.8.3
 * @return array $defaults Default labels
 */
function ffw_alerts_get_default_labels() {

    $defaults = array(
       'singular' => __( 'Alert', 'ffw_alerts' ),
       'plural' => __( 'Alerts', 'ffw_alerts')
    );

    return apply_filters( 'ffw_alerts_default_name', $defaults );
}

/**
 * Get Singular Label
 *
 * @since 1.0.8.3
 * @return string $defaults['singular'] Singular label
 */
function ffw_alerts_get_label_singular( $lowercase = false ) {
    $defaults = ffw_alerts_get_default_labels();
    return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

/**
 * Get Plural Label
 *
 * @since 1.0.8.3
 * @return string $defaults['plural'] Plural label
 */
function ffw_alerts_get_label_plural( $lowercase = false ) {
    $defaults = ffw_alerts_get_default_labels();
    return ( $lowercase ) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

/**
 * Change default "Enter title here" input
 *
 * @since 1.4.0.2
 * @param string $title Default title placeholder text
 * @return string $title New placeholder text
 */
function ffw_alerts_change_default_title( $title ) {
     $screen = get_current_screen();

     if  ( 'ffw_alerts' == $screen->post_type ) {
        $label = ffw_alerts_get_label_singular();
        $title = sprintf( __( 'Enter %s title here', 'ffw_alerts' ), $label );
     }

     return $title;
}
add_filter( 'enter_title_here', 'ffw_alerts_change_default_title' );




/**
 * Updated Messages
 *
 * Returns an array of with all updated messages.
 *
 * @since 1.0
 * @param array $messages Post updated message
 * @return array $messages New post updated messages
 */
function ffw_alerts_updated_messages( $messages ) {
    global $post, $post_ID;

    $url1 = '<a href="' . get_permalink( $post_ID ) . '">';
    $url2 = ffw_alerts_get_label_singular();
    $url3 = '</a>';

    $messages['ffw_alerts'] = array(
        1 => sprintf( __( '%2$s updated. %1$sView %2$s%3$s.', 'ffw_alerts' ), $url1, $url2, $url3 ),
        4 => sprintf( __( '%2$s updated. %1$sView %2$s%3$s.', 'ffw_alerts' ), $url1, $url2, $url3 ),
        6 => sprintf( __( '%2$s published. %1$sView %2$s%3$s.', 'ffw_alerts' ), $url1, $url2, $url3 ),
        7 => sprintf( __( '%2$s saved. %1$sView %2$s%3$s.', 'ffw_alerts' ), $url1, $url2, $url3 ),
        8 => sprintf( __( '%2$s submitted. %1$sView %2$s%3$s.', 'ffw_alerts' ), $url1, $url2, $url3 )
    );

    return $messages;
}
add_filter( 'post_updated_messages', 'ffw_alerts_updated_messages' );




