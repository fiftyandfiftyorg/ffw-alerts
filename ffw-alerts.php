<?php 
/**
 * Plugin Name: Fifty & Fifty Alerts
 * Plugin URI: http://bryanmonzon.com
 * Description: Create alerts for your site.
 * Version: 1.0
 * Author: Fifty and Fifty
 * Author URI: http://labs.fiftyandfifty.org
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'FFW_ALERTS' ) ) :


/**
 * Main FFW_ALERTS Class
 *
 * @since 1.0 */
final class FFW_ALERTS {

  /**
   * @var FFW_ALERTS Instance
   * @since 1.0
   */
  private static $instance;


  /**
   * FFW_ALERTS Instance / Constructor
   *
   * Insures only one instance of FFW_ALERTS exists in memory at any one
   * time & prevents needing to define globals all over the place. 
   * Inspired by and credit to FFW_ALERTS.
   *
   * @since 1.0
   * @static
   * @uses FFW_ALERTS::setup_globals() Setup the globals needed
   * @uses FFW_ALERTS::includes() Include the required files
   * @uses FFW_ALERTS::setup_actions() Setup the hooks and actions
   * @see FFW_ALERTS()
   * @return void
   */
  public static function instance() {
    if ( ! isset( self::$instance ) && ! ( self::$instance instanceof FFW_ALERTS ) ) {
      self::$instance = new FFW_ALERTS;
      self::$instance->setup_constants();
      self::$instance->includes();
      // self::$instance->load_textdomain();
      // use @examples from public vars defined above upon implementation
    }
    return self::$instance;
  }



  /**
   * Setup plugin constants
   * @access private
   * @since 1.0 
   * @return void
   */
  private function setup_constants() {
    // Plugin version
    if ( ! defined( 'FFW_ALERTS_VERSION' ) )
      define( 'FFW_ALERTS_VERSION', '1.0' );

    // Plugin Folder Path
    if ( ! defined( 'FFW_ALERTS_PLUGIN_DIR' ) )
      define( 'FFW_ALERTS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

    // Plugin Folder URL
    if ( ! defined( 'FFW_ALERTS_PLUGIN_URL' ) )
      define( 'FFW_ALERTS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

    // Plugin Root File
    if ( ! defined( 'FFW_ALERTS_PLUGIN_FILE' ) )
      define( 'FFW_ALERTS_PLUGIN_FILE', __FILE__ );

    if ( ! defined( 'FFW_ALERTS_DEBUG' ) )
      define ( 'FFW_ALERTS_DEBUG', true );
  }



  /**
   * Include required files
   * @access private
   * @since 1.0
   * @return void
   */
  private function includes() {
    global $wp_version;

    // Required Plugin Files
    require_once FFW_ALERTS_PLUGIN_DIR . '/includes/functions.php';
    require_once FFW_ALERTS_PLUGIN_DIR . '/includes/posttypes.php';
    require_once FFW_ALERTS_PLUGIN_DIR . '/includes/scripts.php';
    require_once FFW_ALERTS_PLUGIN_DIR . '/includes/shortcodes.php';

    if( is_admin() ){
        //Admin Required Plugin Files
    }


  }

} /* end FFW_ALERTS class */
endif; // End if class_exists check


/**
 * Main function for returning FFW_ALERTS Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $sqcash = FFW_ALERTS(); ?>
 *
 * @since 1.0
 * @return object The one true FFW_ALERTS Instance
 */
function FFW_ALERTS() {
  return FFW_ALERTS::instance();
}


/**
 * Initiate
 * Run the FFW_ALERTS() function, which runs the instance of the FFW_ALERTS class.
 */
FFW_ALERTS();



/**
 * Debugging
 * @since 1.0
 */
if ( FFW_ALERTS_DEBUG ) {
  ini_set('display_errors','On');
  error_reporting(E_ALL);
}



