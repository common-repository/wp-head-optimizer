<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/admin
 * @author     Nilay Patel <gr8nilay@gmail.com>
 */
class WP_Head_Optimizer_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wp_head_optimizer    The ID of this plugin.
	 */
	private $wp_head_optimizer;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wp_head_optimizer       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp_head_optimizer, $version ) {

		$this->wp_head_optimizer = $wp_head_optimizer;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Head_Optimizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Head_Optimizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->wp_head_optimizer, plugin_dir_url( __FILE__ ) . 'css/wp-head-optimizer-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Head_Optimizer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Head_Optimizer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_register_script( "wpho_ajax_data", plugin_dir_url( __FILE__ ) . 'js/wp-head-optimizer-admin.js', array('jquery'), $this->version, false );
   		 wp_localize_script( 'wpho_ajax_data', 'wphoAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'wphourl' => menu_page_url("wp_head_optimizer_admin_area",false)));   
		 wp_enqueue_script( 'wpho_ajax_data' );
		
		

	}
	
	public function add_admin_menu() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Additional_Fee_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Additional_Fee_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		add_menu_page( 'WP Head Optimizer', 'WP Head Optimizer', 'manage_options', 'wp_head_optimizer_admin_area', 'wp_head_optimizer_admin_area', plugins_url( '/wp-head-optimizer/admin/css/wpho_icon.jpg' ), 110 ); 
		
		require_once 'partials/wp-head-optimizer-admin-display.php';

	}
	
	
	public function save_wpho_form_data(){

		if ( !wp_verify_nonce( $_REQUEST['wpho_nonce'], "save_wpho_value")) {
		  exit("You are not authorize to stay here.");
		} 
		
		update_option('_wpho_saved_values',$_REQUEST);
	}
	
	public function force_login(){
	  echo "Only admin user can save the data";
	  die();	
	
	}

}

function checkOptionValue($wpho_option){
	
	$wpho_option_values = get_option('_wpho_saved_values');
	if (@array_key_exists($wpho_option,$wpho_option_values)){
		$option_value = $wpho_option_values[$wpho_option];	
		if($option_value){
			echo __('checked="checked"','wpho');	
		}
	}
}