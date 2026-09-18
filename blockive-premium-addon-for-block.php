<?php
/**
 * Plugin Name:       Blockive - Premium Addon For Block
 * Description: A powerful Blockive addon plugin that offers a wide range of Blocks
 * Plugin URI: https://mveous.com
 * Version:           1.0.1
 * Requires at least: 6.8
 * Requires PHP:      7.4
 * Author:            Mveous
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blockive-premium-addon-for-block
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Sets up and starts the free plugin. There is only ever one of these.
 *
 * Sets the plugin's constants, loads every class file, and starts the core
 * class. This all happens on `plugins_loaded`, not right away, so that
 * BPAFB_PRO_ACTIVE - always set at the very top of Pro's main file - is
 * already set by the time we check for it, no matter which plugin loads first.
 *
 * When Pro is active, bootstrap() does nothing at all: no constants, no
 * classes, no hooks. Pro has its own copy of everything below. Skipping
 * all of it, not just the class instance, stops "already defined" and
 * "cannot redeclare" errors between the two plugins' copies.
 */
final class Blockive_Premium_Addon_For_Block_Loader
{

	/**
	 * The one and only instance of this class.
	 *
	 * @var Blockive_Premium_Addon_For_Block_Loader|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Blockive_Premium_Addon_For_Block_Loader
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor. Waits until `plugins_loaded` to start the plugin.
	 */
	private function __construct()
	{
		add_action('plugins_loaded', [$this, 'bootstrap']);
	}

	/**
	 * Stops this class from being copied.
	 */
	private function __clone()
	{
	}

	/**
	 * Stops this class from being restored from stored data.
	 */
	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	/**
	 * Starts the plugin. See the note above the class for why this waits.
	 */
	public function bootstrap()
	{
		if (defined('BPAFB_PRO_ACTIVE')) {
			add_action('admin_notices', [$this, 'render_pro_active_notice']);
			return;
		}

		define('BPAFB_PATH', plugin_dir_path(__FILE__));
		define('BPAFB_URL', plugin_dir_url(__FILE__));
		define('BPAFB_VERSION', '1.0.1');

		require_once BPAFB_PATH . 'includes/class-bpafb-core.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-post-type.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-screen-helper.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-builder.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-blocks.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-block-render.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-post-meta-items.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-display-conditions.php';
		require_once BPAFB_PATH . 'includes/class-bpafb-template-frontend-render.php';

		Blockive_Premium_Addon_For_Block::get_instance();
	}

	/**
	 * Shows an admin notice that explains why the free plugin turned itself off.
	 */
	public function render_pro_active_notice()
	{
		if (!current_user_can('activate_plugins')) {
			return;
		}
		echo '<div class="notice notice-info"><p>' .
			esc_html__('Blockive - Premium Addon For Block is inactive because Blockive Pro is active and already includes all of its features. Your existing blocks and templates are unaffected.', 'blockive-premium-addon-for-block') .
			'</p></div>';
	}
}

// Start the plugin (see Blockive_Premium_Addon_For_Block_Loader::bootstrap() for why this waits).
Blockive_Premium_Addon_For_Block_Loader::get_instance();
