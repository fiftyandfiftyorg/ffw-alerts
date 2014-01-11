<?php
/**
 * Shortcodes
 *
 * @package     Fifty and Fifty Alerts
 * @subpackage  Includes
 * @copyright   Copyright (c) 2013, Bryan Monzon
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;




/**
 * Square Button Shortcode
 *
 * Creates the <a> tag for a mailto: link
 * @param  [type] $atts    [description]
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function ffw_alerts_button_shortcode( $atts, $content = null ) 
{

    global $post;

    extract( shortcode_atts( array( 
            'button'        =>  'yellow',
            'title'         =>  'Alert',
            'message'       =>  ''
        ),
        $atts, 'alert_button' )
    );

    ob_start();
    ?>

     <a 
        id="ffw_alert_<?php the_ID(); ?>" 
        href="#alert" 
        class="btn <?php echo $button; ?>" 
        data-local-storage-id="ffw_alerts_<?php echo $post->ID; ?>" 
        data-trigger-method="click" 
        data-title="<?php echo $title ?>" 
        data-content="<?php echo $message; ?>">
        <?php echo $content ?>
     </a>

     <?php
     $alert_button = ob_get_clean();

     echo $alert_button;
 }
 add_shortcode( 'alert_button', 'ffw_alerts_button_shortcode' );