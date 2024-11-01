<?php
/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    WP_Head_Optimizer
 * @subpackage WP_Head_Optimizer/includes
 * @author     Nilay Patel <gr8nilay@gmail.com>
 */
class WP_Head_Optimizer_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		update_option('wpho_deactivated_on',@date('d-m-Y h:i:s'));
	}

}
