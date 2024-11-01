<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/includes
 * @author     Your Name <email@example.com>
 */
class WP_Head_Optimizer_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		update_option('wpho_activated_on',@date('d-m-Y h:i:s'));
	}

}
