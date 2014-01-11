<?php
/**
 * Functions
 *
 * @package     Fifty and Fifty Alerts
 * @subpackage  Functions
 * @copyright   Copyright (c) 2013, Bryan Monzon
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get the Alerts and output them to do_action( 'ffw_alerts_output' ) in the header
 * @return [type] [description]
 */
function ffw_display_alerts() 
{

  ob_start();
  ?>
  <!-- ==================== -->
  <!--         ALERTS       -->
  <!-- ==================== -->
  <div id="alerts">
    <div id="alert_container"></div>
    <div id="alert_close"></div>
  </div>
  
  <?php
  $ffw_display_alerts = ob_get_clean();
  echo $ffw_display_alerts;

}
add_action( 'ffw_alerts_output', 'ffw_display_alerts' );

/**
 * Get the Alerts and output them to do_action( 'ffw_alerts_output' ) in the header
 * @return [type] [description]
 */
function ffw_get_alerts() 
{
    $alerts_args = array(
        'post_type' => 'ffw_alerts',
        'numberposts'   => 1,
        'post_status'   => 'publish'
    );
    $alerts_query = new WP_query( $alerts_args );
    
    ob_start();    
    
    while( $alerts_query->have_posts() ) : $alerts_query->the_post(); 

    ?>
     <a 
        id="ffw_alert_<?php the_ID(); ?>" 
        href="#alert" 
        class="btn yellow hide" 
        data-local-storage-id="ffw_alerts_<?php the_ID(); ?>" 
        data-trigger-method="onpageload" 
        data-title="<?php the_title(); ?>" 
        data-content="<?php echo get_the_excerpt(); ?>">
        Test Alert
     </a>
    <?php 
    endwhile;
    wp_reset_query();

    $ffw_display_alert_trigger = ob_get_clean();

    echo $ffw_display_alert_trigger;
}
add_action( 'ffw_alerts_output', 'ffw_get_alerts' );