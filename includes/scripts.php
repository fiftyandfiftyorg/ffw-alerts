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
    
    // Enqueue jQuery
    wp_enqueue_script('jquery');
    
    // Register Scripts / Styles
    wp_register_script('ffw_alert_front_js', FFW_ALERTS_PLUGIN_URL . 'assets/js/ffw-alerts-front.js', array( 'jquery' ), FFW_ALERTS_VERSION, true );
    wp_register_style( 'ffw_alert_front_css' FFW_ALERTS_PLUGIN_URK . 'assets/js/ffw-alerts-front.css', true );

    // Enqueue Sripts / Styles
    wp_enqueue_style( 'ffw_alerts_front_styles' );
    wp_enqueue_script( 'ffw_alerts_front_js' );
  

}
add_action('wp_enqueue_scripts', 'ffw_alerts_load_plugin_scripts');