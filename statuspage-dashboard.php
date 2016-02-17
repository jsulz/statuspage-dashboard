<?php
/*
	Plugin Name: Status Page Dashboard
	Plugin URI: https://profiles.wordpress.org/jsulz
	Description: A plugin that can show your application's/company's Status Page components and information in a variety of fashions
	Author: Jared Sulzdorf
	Version: 0.1-alpha
	Author URI: https://profiles.wordpress.org/jsulz
 */
	
// Peace out if you're trying to access this up front
if( ! defined( 'ABSPATH' ) ) exit;

//If this class don't exist, make it so
if( ! class_exists( 'STATDASH' ) ) {

	class STATDASH {

		private static $instance;

			//the magic
	        public static function instance() {

	            if( ! self::$instance ) {

	                self::$instance = new STATDASH( );
	                self::$instance->plugin_constants( );
	                self::$instance->plugin_requires( );
	                //check when text domain can be queued up and load appropriately

	            }

	            return self::$instance;

	        }

	    //the constants (folders and such)
		public function plugin_constants() {

			define( 'STATDASH_FOLDER', plugin_dir_path( __FILE__ ) );
			define( 'STATDASH_INC', trailingslashit( STATDASH_FOLDER . 'inc' ) );
			define( 'STATDASH_CSS', trailingslashit( STATDASH_FOLDER . 'css' ) );
			define( 'STATDASH_JS', trailingslashit( STATDASH_FOLDER . 'js' ) );	
			define( 'STATDASH_WIDGET', STATDASH_INC . 'widget.php' );
			define( 'STATDASH_API_CLIENT', STATDASH_INC . 'client.php' );
			define( 'STATDASH_API_CLIENT', STATDASH_INC . 'scripts.php' );
			define( 'CSS_VERSION', '0.1' );

		}

		//the files
		public function plugin_requires() {

			require( STATDASH_SHORTCODES );
			require( PLUGIN_SCRIPTS ) ;
			require( STATDASH_WIDGET );
			require( STATDASH_API_CLIENT );

		}
		//in case someone wants to translate stuff 
		//Need to refactor as I might need to load this differently similar to load_all_scripts()
		public function class_name_load_plugin_textdomain() {

	    	load_plugin_textdomain( 'statdash', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		}
		
	}

}

//get this show on the road
function statdash_load() {

    return STATDASH::instance( );
    
}

//Check to see if this can be done differently 
add_action( 'plugins_loaded', 'statdash_load' );

?>