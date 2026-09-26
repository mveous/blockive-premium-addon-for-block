<?php
/**
 * Locked "(Pro)" blocks: shows every block that only Blockive Pro has in
 * the inserter, marked with a lock, so people can see what Pro adds. Each
 * one inserts a placeholder that says so and outputs nothing on the site.
 *
 * - Regular blocks (Form, Menu, Slides, ...): build/locked-blocks/index.js,
 *   loaded in every block editor.
 * - Template Blocks (WooCommerce, Events, Site Logo, ...): the teasers in
 *   build/template-blocks/index.js, loaded on the Template Builder screen by
 *   Bpafb_Template_Blocks.
 *
 * Both only register their teasers once this class prints
 * window.bpafbLockedBlocks, and skip any name already registered. The
 * teaser code is copied into Pro by bin/sync-shared-source.js, where this
 * class is never loaded, so it cannot take the real blocks' names there.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Locked_Blocks
{
	const HANDLE = 'bpafb-locked-blocks';

	/**
	 * @var Bpafb_Locked_Blocks|null
	 */
	private static $instance = null;

	/**
	 * @return Bpafb_Locked_Blocks
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		add_action('enqueue_block_editor_assets', [$this, 'enqueue'], 5);
		// After Bpafb_Template_Blocks enqueues its script (priority 20).
		add_action('enqueue_block_editor_assets', [$this, 'add_settings'], 30);
	}

	private function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	public function enqueue()
	{
		$asset_file = BPAFB_PATH . 'build/locked-blocks/index.asset.php';
		if (!file_exists($asset_file)) {
			return;
		}
		$asset = require $asset_file;

		wp_enqueue_script(
			self::HANDLE,
			BPAFB_URL . 'build/locked-blocks/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
		wp_set_script_translations(self::HANDLE, 'blockive-premium-addon-for-block');

		if (file_exists(BPAFB_PATH . 'build/locked-blocks/index.css')) {
			wp_enqueue_style(self::HANDLE, BPAFB_URL . 'build/locked-blocks/index.css', [], $asset['version']);
		}
	}

	/**
	 * Turns the teasers on, with the Blockive block names the server
	 * already has, which must not be taken by a teaser.
	 */
	public function add_settings()
	{
		$registered = array_values(array_filter(
			array_keys(WP_Block_Type_Registry::get_instance()->get_all_registered()),
			function ($name) {
				return 0 === strpos($name, 'blockive-premium-addon-for-block/');
			}
		));
		$settings = 'window.bpafbLockedBlocks = ' . wp_json_encode(['registered' => $registered]) . ';';

		foreach ([self::HANDLE, 'bpafb-template-blocks'] as $handle) {
			if (wp_script_is($handle, 'enqueued')) {
				wp_add_inline_script($handle, $settings, 'before');
			}
		}
	}
}
