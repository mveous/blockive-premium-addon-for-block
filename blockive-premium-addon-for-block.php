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
 * Singleton bootstrap/loader for the free plugin.
 *
 * Defines the plugin constants, requires every class, and instantiates the
 * core class - deferred to `plugins_loaded` so that BPAFB_PRO_ACTIVE -
 * defined unconditionally at the very top of the Pro plugin's main file - is
 * guaranteed to already be defined by now, regardless of which of the two
 * plugins WordPress happened to load first.
 *
 * When Pro is active, bootstrap() defines nothing at all: no constants, no
 * classes, no hooks. Pro ships its own copies of BPAFB_PATH/BPAFB_URL/
 * BPAFB_VERSION and every class below (kept in sync from this plugin), so
 * skipping all of it here - rather than merely skipping instantiation -
 * avoids "constant already defined" / "cannot redeclare class" conflicts
 * between the two plugins' copies, and avoids the two plugins' load order
 * deciding whose BPAFB_PATH etc. wins.
 */
final class Blockive_Premium_Addon_For_Block_Loader
{

	/**
	 * The single instance of this class.
	 *
	 * @var Blockive_Premium_Addon_For_Block_Loader|null
	 */
	private static $instance = null;

	/**
	 * Retrieves (creating if necessary) the single instance of this class.
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
	 * Constructor. Defers all bootstrapping to `plugins_loaded`.
	 */
	private function __construct()
	{
		add_action('plugins_loaded', [$this, 'bootstrap']);
	}

	/**
	 * Prevents cloning of the instance.
	 */
	private function __clone()
	{
	}

	/**
	 * Prevents unserializing of the instance.
	 */
	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	/**
	 * Bootstraps the plugin. See the class docblock for why this is deferred.
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
	 * Shows an admin notice explaining why the free plugin has stood down.
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

// Bootstrap the plugin (see Blockive_Premium_Addon_For_Block_Loader::bootstrap() for why this is deferred).
Blockive_Premium_Addon_For_Block_Loader::get_instance();
