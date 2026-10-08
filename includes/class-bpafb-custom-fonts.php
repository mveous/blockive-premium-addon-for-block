<?php
/**
 * Custom Fonts (a section of Site Tools): upload WOFF2 / WOFF / TTF / OTF
 * files to the Media Library, one row per file with its family, weight,
 * and style. The fonts get @font-face rules on the site and inside the
 * editor, and are added to WordPress's own font lists, so core blocks can
 * pick them; Blockive blocks use them by typing the family name.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Custom_Fonts
{
	const OPTION = 'bpafb_custom_fonts';
	const FORMATS = [
		'woff2' => ['font/woff2', 'woff2'],
		'woff'  => ['font/woff', 'woff'],
		'ttf'   => ['font/ttf', 'truetype'],
		'otf'   => ['font/otf', 'opentype'],
	];

	/**
	 * @var Bpafb_Custom_Fonts|null
	 */
	private static $instance = null;

	/**
	 * @return Bpafb_Custom_Fonts
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
		add_filter('upload_mimes', [$this, 'allow_font_uploads']);
		add_filter('wp_check_filetype_and_ext', [$this, 'check_font_file'], 10, 4);
		add_action('wp_head', [$this, 'print_font_faces'], 5);
		// Inside the editor iframe too.
		add_action('enqueue_block_assets', [$this, 'enqueue_editor_font_faces']);
		add_filter('wp_theme_json_data_theme', [$this, 'add_to_font_lists']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin']);
	}

	private function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	// -- Uploads ----------------------------------------------------------------

	/**
	 * Font files may be uploaded by users who manage the site.
	 *
	 * @param array $mimes Allowed extension => mime type.
	 * @return array
	 */
	public function allow_font_uploads($mimes)
	{
		if (current_user_can('manage_options')) {
			foreach (self::FORMATS as $ext => $format) {
				$mimes[$ext] = $format[0];
			}
		}
		return $mimes;
	}

	/**
	 * Font files are often detected as application/octet-stream, which
	 * WordPress would refuse. Accepts them by extension for users who may
	 * upload fonts.
	 *
	 * @param array  $data     ext, type, proper_filename.
	 * @param string $file     Path to the file.
	 * @param string $filename File name.
	 * @param array  $mimes    Allowed mime types.
	 * @return array
	 */
	public function check_font_file($data, $file, $filename, $mimes)
	{
		if (!empty($data['ext']) || !current_user_can('manage_options')) {
			return $data;
		}
		$ext = strtolower(pathinfo((string) $filename, PATHINFO_EXTENSION));
		if (isset(self::FORMATS[$ext])) {
			$data['ext'] = $ext;
			$data['type'] = self::FORMATS[$ext][0];
		}
		return $data;
	}

	// -- Settings ---------------------------------------------------------------

	/**
	 * @param mixed $value Submitted rows.
	 * @return array[]
	 */
	public static function sanitize($value)
	{
		$rows = [];
		foreach ((array) $value as $row) {
			if (!is_array($row)) {
				continue;
			}
			$family = trim(preg_replace('/[^\p{L}\p{N} _-]/u', '', isset($row['family']) ? (string) $row['family'] : ''));
			$id = isset($row['id']) ? absint($row['id']) : 0;
			if ('' === $family || !$id || !self::format_of($id)) {
				continue;
			}
			$weight = isset($row['weight']) ? (string) $row['weight'] : '400';
			$rows[] = [
				'family' => mb_substr($family, 0, 60),
				'weight' => preg_match('/^[1-9]00$/', $weight) ? $weight : '400',
				'style'  => isset($row['style']) && 'italic' === $row['style'] ? 'italic' : 'normal',
				'id'     => $id,
			];
		}
		return $rows;
	}

	/**
	 * The font format of an uploaded file, or null when it is not a font.
	 *
	 * @param int $attachment_id Attachment ID.
	 * @return array|null [mime, css format]
	 */
	private static function format_of($attachment_id)
	{
		$file = get_attached_file($attachment_id);
		$ext = strtolower(pathinfo((string) $file, PATHINFO_EXTENSION));
		return 'attachment' === get_post_type($attachment_id) && isset(self::FORMATS[$ext]) ? self::FORMATS[$ext] : null;
	}

	/**
	 * @return array[] Saved rows.
	 */
	public static function rows()
	{
		$rows = get_option(self::OPTION, []);
		return is_array($rows) ? $rows : [];
	}

	// -- Output -------------------------------------------------------------------

	/**
	 * @return string @font-face rules for every saved font file.
	 */
	public static function css()
	{
		$css = '';
		foreach (self::rows() as $row) {
			$format = self::format_of($row['id']);
			$url = wp_get_attachment_url($row['id']);
			if (!$format || !$url) {
				continue;
			}
			$css .= sprintf(
				'@font-face{font-family:"%1$s";src:url("%2$s") format("%3$s");font-weight:%4$s;font-style:%5$s;font-display:swap;}',
				esc_attr($row['family']),
				esc_url($url),
				$format[1],
				(int) $row['weight'],
				'italic' === $row['style'] ? 'italic' : 'normal'
			);
		}
		return $css;
	}

	public function print_font_faces()
	{
		$css = self::css();
		if ($css) {
			echo '<style id="bpafb-custom-fonts">' . $css . '</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from escaped parts.
		}
	}

	public function enqueue_editor_font_faces()
	{
		if (!is_admin()) {
			return;
		}
		$css = self::css();
		if ($css) {
			wp_register_style('bpafb-custom-fonts', false, [], BPAFB_VERSION);
			wp_enqueue_style('bpafb-custom-fonts');
			wp_add_inline_style('bpafb-custom-fonts', $css);
		}
	}

	/**
	 * Adds each family to the theme's font list (name and CSS family only;
	 * the @font-face rules above load the files).
	 *
	 * @param WP_Theme_JSON_Data $theme_json Theme data.
	 * @return WP_Theme_JSON_Data
	 */
	public function add_to_font_lists($theme_json)
	{
		$families = array_unique(wp_list_pluck(self::rows(), 'family'));
		if (!$families) {
			return $theme_json;
		}
		$data = $theme_json->get_data();
		$list = isset($data['settings']['typography']['fontFamilies']) && is_array($data['settings']['typography']['fontFamilies']) ? $data['settings']['typography']['fontFamilies'] : [];
		// Theme data can be grouped by origin.
		if (isset($list['theme']) && is_array($list['theme'])) {
			$list = $list['theme'];
		}
		foreach ($families as $family) {
			$list[] = [
				'name'       => $family,
				'slug'       => 'bpafb-' . sanitize_title($family),
				'fontFamily' => '"' . $family . '", sans-serif',
			];
		}
		return $theme_json->update_with([
			'version'  => isset($data['version']) ? $data['version'] : 3,
			'settings' => ['typography' => ['fontFamilies' => $list]],
		]);
	}

	// -- Site Tools section -------------------------------------------------------

	public function enqueue_admin($hook)
	{
		if (false === strpos((string) $hook, Bpafb_Site_Tools::PAGE)) {
			return;
		}
		wp_enqueue_media();
	}

	/**
	 * The Custom Fonts section of the Site Tools form.
	 */
	public static function render_section()
	{
		$rows = self::rows();
		$weights = ['100', '200', '300', '400', '500', '600', '700', '800', '900'];
		$name = self::OPTION;
		?>
		<div class="bpafb-card">
			<div class="bpafb-card-header">
				<div class="bpafb-card-header-left">
					<h2><?php esc_html_e('Custom Fonts Manager', 'blockive-premium-addon-for-block'); ?></h2>
					<p><?php esc_html_e('Upload local font files (WOFF2, WOFF, TTF, OTF). Registered fonts automatically load in the editor and on the front end.', 'blockive-premium-addon-for-block'); ?></p>
				</div>
				<button type="button" class="bpafb-btn-primary" id="bpafb-font-add" style="padding: 8px 16px; font-size: 12px;">
					<span class="dashicons dashicons-plus-alt2" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span>
					<?php esc_html_e('Add Font File', 'blockive-premium-addon-for-block'); ?>
				</button>
			</div>
			<div class="bpafb-card-body">
				<div class="bpafb-fonts-table-wrap">
				<table class="bpafb-fonts-table" id="bpafb-fonts">
					<thead>
						<tr>
							<th scope="col" style="width: 32%;"><?php esc_html_e('Font Family Name', 'blockive-premium-addon-for-block'); ?></th>
							<th scope="col" style="width: 14%;"><?php esc_html_e('Weight', 'blockive-premium-addon-for-block'); ?></th>
							<th scope="col" style="width: 16%;"><?php esc_html_e('Style', 'blockive-premium-addon-for-block'); ?></th>
							<th scope="col" style="width: 30%;"><?php esc_html_e('Font File', 'blockive-premium-addon-for-block'); ?></th>
							<th scope="col" style="width: 8%; text-align: right;"><span class="screen-reader-text"><?php esc_html_e('Actions', 'blockive-premium-addon-for-block'); ?></span></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$render_row = function ($index, $row) use ($name, $weights) {
							$file = !empty($row['id']) ? basename((string) get_attached_file($row['id'])) : '';
							?>
							<tr class="bpafb-font-row">
								<td><input type="text" class="regular-text" style="width: 100%; border-radius: var(--bpafb-radius-sm); border: 1px solid var(--bpafb-slate-300);" aria-label="<?php esc_attr_e('Family', 'blockive-premium-addon-for-block'); ?>" name="<?php echo esc_attr($name . '[' . $index . '][family]'); ?>" value="<?php echo esc_attr(isset($row['family']) ? $row['family'] : ''); ?>" placeholder="e.g. Brand Sans"></td>
								<td>
									<select style="width: 100%; border-radius: var(--bpafb-radius-sm); border: 1px solid var(--bpafb-slate-300);" aria-label="<?php esc_attr_e('Weight', 'blockive-premium-addon-for-block'); ?>" name="<?php echo esc_attr($name . '[' . $index . '][weight]'); ?>">
										<?php foreach ($weights as $weight) : ?>
											<option value="<?php echo esc_attr($weight); ?>" <?php selected(isset($row['weight']) ? $row['weight'] : '400', $weight); ?>><?php echo esc_html($weight); ?></option>
										<?php endforeach; ?>
									</select>
								</td>
								<td>
									<select style="width: 100%; border-radius: var(--bpafb-radius-sm); border: 1px solid var(--bpafb-slate-300);" aria-label="<?php esc_attr_e('Style', 'blockive-premium-addon-for-block'); ?>" name="<?php echo esc_attr($name . '[' . $index . '][style]'); ?>">
										<option value="normal" <?php selected(isset($row['style']) ? $row['style'] : 'normal', 'normal'); ?>><?php esc_html_e('Normal', 'blockive-premium-addon-for-block'); ?></option>
										<option value="italic" <?php selected(isset($row['style']) ? $row['style'] : 'normal', 'italic'); ?>><?php esc_html_e('Italic', 'blockive-premium-addon-for-block'); ?></option>
									</select>
								</td>
								<td>
									<input type="hidden" class="bpafb-font-id" name="<?php echo esc_attr($name . '[' . $index . '][id]'); ?>" value="<?php echo esc_attr(isset($row['id']) ? (int) $row['id'] : ''); ?>">
									<div style="display: flex; align-items: center; gap: 8px;">
										<button type="button" class="button bpafb-font-pick" style="border-radius: var(--bpafb-radius-sm);"><?php esc_html_e('Choose File', 'blockive-premium-addon-for-block'); ?></button>
										<span class="bpafb-font-file bpafb-font-file-badge" style="<?php echo empty($file) ? 'display:none;' : ''; ?>"><?php echo esc_html($file); ?></span>
									</div>
								</td>
								<td style="text-align: right;">
									<button type="button" class="button-link button-link-delete bpafb-font-remove" style="color: var(--bpafb-danger); text-decoration: none;" title="<?php esc_attr_e('Remove row', 'blockive-premium-addon-for-block'); ?>">
										<span class="dashicons dashicons-trash" aria-hidden="true" style="font-size: 18px; width: 18px; height: 18px; line-height: 18px;"></span>
										<span class="screen-reader-text"><?php esc_html_e('Remove font', 'blockive-premium-addon-for-block'); ?></span>
									</button>
								</td>
							</tr>
							<?php
						};
						foreach ($rows as $index => $row) {
							$render_row($index, $row);
						}
						?>
					</tbody>
				</table>
				</div>
				<p class="bpafb-fonts-empty" id="bpafb-fonts-empty"<?php echo $rows ? ' hidden' : ''; ?>><?php esc_html_e('No custom fonts yet. Click Add Font File to upload your first one.', 'blockive-premium-addon-for-block'); ?></p>
				<template id="bpafb-font-template"><?php $render_row('__i__', []); ?></template>
			</div>
		</div>
		<script>
		( function () {
			var table = document.querySelector( '#bpafb-fonts tbody' );
			if ( ! table ) return;
			var empty = document.getElementById( 'bpafb-fonts-empty' );
			var wrap = document.querySelector( '.bpafb-fonts-table-wrap' );
			function syncEmpty() {
				var none = ! table.querySelector( '.bpafb-font-row' );
				if ( empty ) {
					empty.hidden = ! none;
				}
				if ( wrap ) {
					wrap.hidden = none;
				}
			}
			syncEmpty();
			var next = <?php echo (int) (count($rows) ? max(array_keys($rows)) + 1 : 0); ?>;
			var addBtn = document.getElementById( 'bpafb-font-add' );
			if ( addBtn ) {
				addBtn.addEventListener( 'click', function () {
					var html = document.getElementById( 'bpafb-font-template' ).innerHTML.split( '__i__' ).join( String( next++ ) );
					table.insertAdjacentHTML( 'beforeend', html );
					syncEmpty();
					table.lastElementChild.querySelector( 'input[type="text"]' ).focus();
				} );
			}
			table.addEventListener( 'click', function ( event ) {
				var row = event.target.closest( '.bpafb-font-row' );
				if ( ! row ) {
					return;
				}
				if ( event.target.closest( '.bpafb-font-remove' ) ) {
					row.remove();
					syncEmpty();
					return;
				}
				if ( event.target.closest( '.bpafb-font-pick' ) && window.wp && wp.media ) {
					var frame = wp.media( { title: <?php echo wp_json_encode(__('Choose a font file', 'blockive-premium-addon-for-block')); ?>, multiple: false } );
					frame.on( 'select', function () {
						var file = frame.state().get( 'selection' ).first().toJSON();
						row.querySelector( '.bpafb-font-id' ).value = file.id;
						var badge = row.querySelector( '.bpafb-font-file' );
						badge.textContent = file.filename;
						badge.style.display = 'inline-flex';
					} );
					frame.open();
				}
			} );
		} )();
		</script>
		<?php
	}
}
