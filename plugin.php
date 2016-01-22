<?php
/*
	Plugin Name: 
	Plugin URI: https://profiles.wordpress.org/jsulz
	Description: 
	Author: Jared Sulzdorf
	Version: 1.0.0
	Author URI: https://profiles.wordpress.org/jsulz
 */
	
// Peace out if you're trying to access this up front
if( ! defined( 'ABSPATH' ) ) exit;

//If this class don't exist, make it so
if( ! class_exists( 'CLASSNAME' ) ) {

	class CLASSNAME {

		private static $instance;

			//the magic
	        public static function instance() {

	            if( ! self::$instance ) {

	                self::$instance = new CLASSNAME( );
	                self::$instance->plugin_constants( );
	                self::$instance->plugin_requires( );
	                add_action( 'wp_enqueue_scripts', array( self::$instance, 'load_all_scripts' ) );
	                //check when text domain can be queued up and load appropriately

	            }

	            return self::$instance;

	        }

	    //the constants (folders and such)
		public function plugin_constants() {

			define( 'PLUGIN_FOLDER', plugin_dir_path( __FILE__ ) );
			define( 'PLUGIN_INC', trailingslashit( PLUGIN_FOLDER . 'inc' ) );
			define( 'PLUGIN_CSS', trailingslashit( PLUGIN_FOLDER . 'css' ) );
			define( 'PLUGIN_JS', trailingslashit( PLUGIN_FOLDER . 'js' ) );	
			define( 'PLUGIN_SHORTCODES', PLUGIN_INC . 'shortcodes.php');
			define( 'PLUGIN_WIDGET', PLUGIN_INC . 'widget.php' );
			define( 'PLUGIN_API_CLIENT', PLUGIN_INC . 'client.php' );

		}

		//the files
		public function plugin_requires() {

			require( PLUGIN_SHORTCODES );
			require( PLUGIN_SCRIPTS ) ;
			require( PLUGIN_WIDGET );
			require( PLUGIN_API_CLIENT );

		}
		//in case someone wants to translate stuff 
		//Need to refactor as I might need to load this differently similar to load_all_scripts()
		public function class_name_load_plugin_textdomain() {

	    	load_plugin_textdomain( 'text-domain', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		}

		//Add this to it's own file - scripts.php
		//Don't hardcode version number - add as constant
		public function load_all_scripts() {

			wp_enqueue_style( 'handle', plugin_dir_url( __FILE__ ) . 'css/styles.css', array(), '0.1', 'all' );
		}
		
	}

}

//get this show on the road
function class_name_as_function() {

    return CLASSNAME::instance( );
    
}

//Check to see if this can be done differently 
add_action( 'plugins_loaded', 'class_name_as_function' );

?>