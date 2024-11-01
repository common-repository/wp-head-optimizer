<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/public
 * @author     Your Name <email@example.com>
 */
class WP_Head_Optimizer_Public {

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
	 * @param      string    $wp_head_optimizer       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $wp_head_optimizer, $version ) {

		$this->wp_head_optimizer = $wp_head_optimizer;
		$this->version = $version;

	}

	public function wpho_head_optmizer(){
		
		if(!is_admin()){
			$wpho_option_values = get_option('_wpho_saved_values');
			
			//Disable WP Emoji
			if($wpho_option_values['_wpho_emoji'] == 1){
				
				// remove actions / filters related to emojis
				remove_action( 'admin_print_styles', 'print_emoji_styles' );
				remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
				remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
				remove_action( 'wp_print_styles', 'print_emoji_styles' );
				remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
				remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
				remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
				
				// added filter to remove TinyMCE emojis as well
				add_filter( 'tiny_mce_plugins', 'disable_wp_emojicons_tinymce' );	
			}
			
			//Remove Canonical URL
			if($wpho_option_values['_wpho_canonical'] == 1){
				remove_action('wp_head', 'rel_canonical');
			}
			
			
			//Remove WordPress Version			
			if($wpho_option_values['_wpho_wp_version'] == 1){
				remove_action('wp_head', 'wp_generator');
			}
			
			//Remove Shortlink		
			if($wpho_option_values['_wpho_shortlink'] == 1){
				remove_action('wp_head', 'wp_shortlink_wp_head');
			}
			
			//Remove RSS Feed URL		
			if($wpho_option_values['_wpho_rss_feed'] == 1){
				remove_action( 'wp_head', 'feed_links_extra', 3 ); //Extra feeds such as category feeds
				remove_action( 'wp_head', 'feed_links', 2 ); // General feeds: Post and Comment Feed
			}
			
			//Remove EditURI		
			if($wpho_option_values['_wpho_edituri'] == 1){
				remove_action ('wp_head', 'rsd_link');
			}
			
			//Disable JSON API		
			if($wpho_option_values['_wpho_jsonapi'] == 1){
				add_filter('json_enabled', '__return_false');
				add_filter('json_jsonp_enabled', '__return_false');
			}
			
			
			//Remove Style and Script Versions
			if($wpho_option_values['_wpho_ss_vesions'] == 1){
				add_filter( 'style_loader_src', 'wpho_remove_ver_css_js', 9999 );
				add_filter( 'script_loader_src', 'wpho_remove_ver_css_js', 9999 );
			}
			
			//Remove WLW Manifest
			if($wpho_option_values['_wpho_wlwmanifest'] == 1){
				remove_action( 'wp_head', 'wlwmanifest_link');
			}
			
			//Remove Next/Previous Post URLs Links
			if($wpho_option_values['_wpho_np_urls'] == 1){
				remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
			}
			
			//Remove REST API link tags
			if($wpho_option_values['_wpho_restapi_link'] == 1){
				remove_action('wp_head', 'rest_output_link_wp_head', 10);
			}
			
			// Remove oEmbed Discovery Links
			if($wpho_option_values['_wpho_oembed_desc_link'] == 1){
				remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
			}
			
			
			
		}
	}
}


function wpho_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}