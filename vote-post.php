<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fiverr.com/wpdevmehedi
 * @since             1.0.0
 * @package           Vote_Post
 *
 * @wordpress-plugin
 * Plugin Name:       Vote post
 * Plugin URI:        https://fiverr.com
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Mehedi Hasan
 * Author URI:        https://fiverr.com/wpdevmehedi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vote-post
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'VOTE_POST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vote-post-activator.php
 */
function activate_vote_post() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vote-post-activator.php';
	Vote_Post_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vote-post-deactivator.php
 */
function deactivate_vote_post() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vote-post-deactivator.php';
	Vote_Post_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vote_post' );
register_deactivation_hook( __FILE__, 'deactivate_vote_post' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vote-post.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vote_post() {

	$plugin = new Vote_Post();
	$plugin->run();

}
run_vote_post();
