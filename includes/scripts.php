<?php
/**
 * Scripts
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Register Scripts
 *
 * @since  1.0
 * @author  Bryan Monzon <[email]>
 * @return [type] [description]
 */
function ffw_alerts_load_plugin_scripts() {
    
    
 
    wp_enqueue_script('jquery');
    
    wp_register_script('ffw_alerts_front', FFW_ALERTS_PLUGIN_URL . 'assets/js/ffw-alerts-front.js', array( 'jquery' ), FFW_ALERTS_VERSION, true );
    wp_enqueue_script( 'ffw_alerts_front' );

    wp_enqueue_style('ffw_faqs_styles', FFW_ALERTS_PLUGIN_URL . 'assets/css/ffw-alerts-front.css');

  

}
add_action('wp_enqueue_scripts', 'ffw_alerts_load_plugin_scripts');