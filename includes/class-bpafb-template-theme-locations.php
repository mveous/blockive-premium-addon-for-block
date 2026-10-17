<?php
/**
 * Shows a matched Header or Footer Blockive Template (see
 * Bpafb_Template_Kinds) on the live site, in a real <header> / <footer>
 * element, in place of the active theme's own:
 *
 * - Block themes: the theme's header / footer template part is swapped
 *   for ours where it stands (see replace_template_part()).
 * - Classic themes listed in THEMES (Astra, GeneratePress, OceanWP,
 *   Kadence, Neve, Blocksy): the theme's own header / footer is taken off
 *   the hook that prints it, and ours is added to that hook instead, the
 *   same way these themes support Elementor Pro and Beaver Themer. The
 *   theme's page wrappers, styles, and scripts stay as they are.
 * - Any other classic theme: header.php / footer.php are replaced as a
 *   whole (see take_over_header() / take_over_footer()). The theme's
 *   header.php is still run, with its output thrown away, so nothing it
 *   sets up (enqueued scripts/styles, etc.) is lost.
 *
 * This is a trimmed, free-plugin version of the Pro plugin's
 * Bpafb_Pro_Theme_Locations: Header and Footer only (no Archive/Search/404
 * page swapping), always full width (no custom-width layout setting), and
 * no sticky-header behavior - all Pro-only polish on top of this same
 * mechanism.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Template_Theme_Locations
{
	/**
	 * Classic themes with their own header / footer hooks (parent theme
	 * slug => settings), for header and footer:
	 * - hook:    where our header / footer is printed.
	 * - remove:  hook => '*' (everything on it) or the callbacks to take
	 *            off ('function' or 'Class::method'), which together print
	 *            the theme's own header / footer.
	 * - disable: a filter that turns the theme's own one off.
	 */
	const THEMES = [
		'astra'         => [
			'header' => ['hook' => 'astra_header', 'remove' => ['astra_header' => '*']],
			// astra_footer also holds the header's mobile menu popup, so
			// only the footer markup itself comes off.
			'footer' => ['hook' => 'astra_footer', 'remove' => ['astra_footer' => ['astra_footer_markup', 'Astra_Builder_Footer::footer_markup']]],
		],
		'generatepress' => [
			'header' => [
				'hook'   => 'generate_header',
				'remove' => [
					'generate_header'        => '*',
					'generate_before_header' => ['generate_top_bar', 'generate_add_navigation_before_header'],
					'generate_after_header'  => ['generate_add_navigation_after_header'],
				],
			],
			'footer' => ['hook' => 'generate_footer', 'remove' => ['generate_footer' => '*']],
		],
		'oceanwp'       => [
			'header' => ['hook' => 'ocean_header', 'remove' => ['ocean_header' => '*', 'ocean_top_bar' => '*']],
			'footer' => ['hook' => 'ocean_footer', 'remove' => ['ocean_footer' => '*']],
		],
		'kadence'       => [
			'header' => ['hook' => 'kadence_header', 'remove' => ['kadence_header' => '*']],
			'footer' => ['hook' => 'kadence_footer', 'remove' => ['kadence_footer' => '*']],
		],
		'neve'          => [
			'header' => ['hook' => 'neve_do_header', 'remove' => ['neve_do_header' => '*']],
			'footer' => ['hook' => 'neve_do_footer', 'remove' => ['neve_do_footer' => '*']],
		],
		'blocksy'       => [
			'header' => ['hook' => 'blocksy:header:before', 'disable' => 'blocksy:builder:header:enabled'],
			'footer' => ['hook' => 'blocksy:footer:before', 'disable' => 'blocksy:builder:footer:enabled'],
		],
	];

	/**
	 * The one and only instance of this class.
	 *
	 * @var Bpafb_Template_Theme_Locations|null
	 */
	private static $instance = null;

	/**
	 * Gives back the one instance of this class, making it first if needed.
	 *
	 * @return Bpafb_Template_Theme_Locations
	 */
	public static function get_instance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct()
	{
		// Late, once the theme has added its own header / footer callbacks.
		add_action('template_redirect', [$this, 'set_up_header_footer'], PHP_INT_MAX);
		add_filter('pre_render_block', [$this, 'replace_template_part'], 10, 2);
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
	 * The matched Header or Footer template for this page, wrapped in a
	 * real <header> / <footer> (or $tag), or '' when none matches.
	 *
	 * @param string $kind    'header' or 'footer'.
	 * @param string $tag     Wrapper element.
	 * @param array  $classes Extra classes.
	 * @return string
	 */
	private static function markup($kind, $tag = '', array $classes = [])
	{
		$template_id   = Bpafb_Template_Kinds::get_matching_template_id($kind);
		$template_post = $template_id ? get_post($template_id) : null;
		if (!$template_post || '' === trim($template_post->post_content)) {
			return '';
		}

		$tag     = in_array($tag, ['header', 'footer', 'div', 'section'], true) ? $tag : $kind;
		$classes = array_merge($classes, ['bpafb-template-render', 'bpafb-' . $kind]);

		return '<' . $tag . ' class="' . esc_attr(implode(' ', $classes)) . '">'
			. do_blocks($template_post->post_content)
			. '</' . $tag . '>';
	}

	/**
	 * Hooks the matched Header / Footer into a classic theme (block themes
	 * are handled block by block in replace_template_part()).
	 */
	public function set_up_header_footer()
	{
		if (is_admin() || wp_is_block_theme()) {
			return;
		}

		/**
		 * Theme settings for placing the Header / Footer in a classic theme
		 * (see THEMES), so another theme can be added.
		 *
		 * @param array  $settings THEMES entry for this theme, or [].
		 * @param string $theme    Parent theme slug.
		 */
		$settings = apply_filters('bpafb_theme_location_hooks', self::THEMES[get_template()] ?? [], get_template());

		foreach (['header', 'footer'] as $kind) {
			if (!Bpafb_Template_Kinds::get_matching_template_id($kind)) {
				continue;
			}
			if (!empty($settings[$kind]['hook'])) {
				$this->use_theme_hook($kind, $settings[$kind]);
			} else {
				add_action('get_' . $kind, [$this, 'take_over_' . $kind], PHP_INT_MAX);
			}
		}
	}

	/**
	 * Takes a known theme's own header / footer off and puts ours on the
	 * same hook.
	 *
	 * @param string $kind     'header' or 'footer'.
	 * @param array  $settings THEMES entry for $kind.
	 */
	private function use_theme_hook($kind, array $settings)
	{
		foreach ($settings['remove'] ?? [] as $hook => $callbacks) {
			self::remove_callbacks($hook, $callbacks);
		}
		if (!empty($settings['disable'])) {
			add_filter($settings['disable'], '__return_false', PHP_INT_MAX);
		}
		add_action($settings['hook'], function () use ($kind) {
			echo self::markup($kind); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by markup().
		});
	}

	/**
	 * @param string          $hook      Action name.
	 * @param string|string[] $callbacks '*' or 'function' / 'Class::method' names.
	 */
	private static function remove_callbacks($hook, $callbacks)
	{
		global $wp_filter;
		if ('*' === $callbacks) {
			remove_all_actions($hook);
			return;
		}
		if (empty($wp_filter[$hook])) {
			return;
		}
		foreach ($wp_filter[$hook]->callbacks as $priority => $list) {
			foreach ($list as $callback) {
				$function = $callback['function'];
				if (is_array($function) && 2 === count($function)) {
					$name = (is_object($function[0]) ? get_class($function[0]) : (string) $function[0]) . '::' . $function[1];
				} else {
					$name = is_string($function) ? $function : '';
				}
				if (in_array($name, (array) $callbacks, true)) {
					remove_action($hook, $function, $priority);
				}
			}
		}
	}

	/**
	 * Replaces an unknown classic theme's header.php (on `get_header`):
	 * prints the page head and our header, then runs the theme's
	 * header.php with its output thrown away and its <head> hooks
	 * already done.
	 *
	 * @param string|null $name Header name passed to get_header().
	 */
	public function take_over_header($name)
	{
		?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		<?php
		wp_body_open();
		echo self::markup('header'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by markup().

		remove_all_actions('wp_head');
		remove_all_actions('wp_body_open');
		self::discard_theme_file('header', $name);
	}

	/**
	 * Replaces an unknown classic theme's footer.php (on `get_footer`):
	 * prints our footer and closes the page, then runs the theme's
	 * footer.php with its output thrown away.
	 *
	 * @param string|null $name Footer name passed to get_footer().
	 */
	public function take_over_footer($name)
	{
		echo self::markup('footer'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built by markup().
		wp_footer();
		echo "\n</body>\n</html>\n";

		remove_all_actions('wp_footer');
		self::discard_theme_file('footer', $name);
	}

	/**
	 * Runs the theme's header.php / footer.php without printing it (what
	 * get_header() / get_footer() would load next).
	 *
	 * @param string      $kind 'header' or 'footer'.
	 * @param string|null $name Name passed to get_header() / get_footer().
	 */
	private static function discard_theme_file($kind, $name)
	{
		$templates = [];
		$name = (string) $name;
		if ('' !== $name) {
			$templates[] = $kind . '-' . $name . '.php';
		}
		$templates[] = $kind . '.php';

		ob_start();
		locate_template($templates, true);
		ob_end_clean();
	}

	/**
	 * On a block theme, shows the matched Header / Footer in place of the
	 * theme's own header / footer template part, in the same element.
	 *
	 * @param string|null $pre_render   Short-circuit value; non-null skips this block entirely.
	 * @param array       $parsed_block The block about to render.
	 * @return string|null
	 */
	public function replace_template_part($pre_render, $parsed_block)
	{
		if (null !== $pre_render || is_admin() || 'core/template-part' !== ($parsed_block['blockName'] ?? '')) {
			return $pre_render;
		}

		$attrs = $parsed_block['attrs'] ?? [];
		foreach (['header', 'footer'] as $kind) {
			if ($kind !== ($attrs['slug'] ?? '') && $kind !== ($attrs['area'] ?? '')) {
				continue;
			}
			if (!Bpafb_Template_Kinds::get_matching_template_id($kind)) {
				return $pre_render;
			}
			$classes = ['wp-block-template-part'];
			if (!empty($attrs['className'])) {
				$classes[] = $attrs['className'];
			}
			return self::markup($kind, $attrs['tagName'] ?? $kind, $classes);
		}

		return $pre_render;
	}
}
