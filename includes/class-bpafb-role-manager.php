<?php
/**
 * Role Manager (a section of Site Tools): which roles can use the
 * Template Builder. Headers, footers, popups, and other templates change
 * the whole site, so a site owner can keep, say, Authors out of them while
 * they still write posts.
 *
 * The template post type gets its own capabilities (edit_bpafb_templates,
 * ...) instead of sharing the post ones, and a user has each of them only
 * when they have the matching post capability and an allowed role. With no
 * roles chosen, everyone who can edit posts keeps access, as before.
 * Administrators always have access.
 *
 * @package Blockive
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class Bpafb_Role_Manager
{
	const OPTION = 'bpafb_template_roles';
	const CAP_TYPE = ['bpafb_template', 'bpafb_templates'];

	/**
	 * @var Bpafb_Role_Manager|null
	 */
	private static $instance = null;

	/**
	 * @return Bpafb_Role_Manager
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
		add_filter('register_post_type_args', [$this, 'own_capabilities'], 10, 2);
		add_filter('user_has_cap', [$this, 'grant'], 10, 4);
	}

	private function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception('Cannot unserialize a singleton.');
	}

	/**
	 * @param array  $args      Post type arguments.
	 * @param string $post_type Post type.
	 * @return array
	 */
	public function own_capabilities($args, $post_type)
	{
		if (Bpafb_Template_Post_Type::POST_TYPE === $post_type) {
			$args['capability_type'] = self::CAP_TYPE;
			$args['map_meta_cap'] = true;
		}
		return $args;
	}

	/**
	 * Roles allowed to use the Template Builder, or [] for everyone who
	 * can edit posts.
	 *
	 * @return string[]
	 */
	public static function allowed_roles()
	{
		$roles = get_option(self::OPTION, []);
		return is_array($roles) ? $roles : [];
	}

	/**
	 * Gives each template capability when the user has the post
	 * capability it stands for and an allowed role.
	 *
	 * @param array   $allcaps All the user's capabilities.
	 * @param array   $caps    Primitive capabilities being checked.
	 * @param array   $args    Requested capability and arguments.
	 * @param WP_User $user    User.
	 * @return array
	 */
	public function grant($allcaps, $caps, $args, $user)
	{
		$suffix = '_' . self::CAP_TYPE[1];
		foreach ($caps as $cap) {
			if (substr($cap, -strlen($suffix)) !== $suffix) {
				continue;
			}
			$post_cap = substr($cap, 0, -strlen($suffix)) . '_posts';
			if (!empty($allcaps[$post_cap]) && self::role_allowed($user)) {
				$allcaps[$cap] = true;
			}
		}
		return $allcaps;
	}

	/**
	 * @param WP_User $user User.
	 * @return bool
	 */
	private static function role_allowed($user)
	{
		$allowed = self::allowed_roles();
		if (!$allowed || in_array('administrator', (array) $user->roles, true) || !empty($user->allcaps['manage_options'])) {
			return true;
		}
		return (bool) array_intersect($allowed, (array) $user->roles);
	}

	/**
	 * @param mixed $value Submitted role slugs.
	 * @return string[]
	 */
	public static function sanitize($value)
	{
		$roles = array_keys(wp_roles()->roles);
		return array_values(array_intersect(array_map('strval', (array) $value), $roles));
	}

	/**
	 * The Template Builder Access section of the Site Tools form.
	 */
	public static function render_section()
	{
		$allowed = self::allowed_roles();
		?>
		<div class="bpafb-card">
			<div class="bpafb-card-header">
				<div class="bpafb-card-header-left">
					<h2><?php esc_html_e('Template Builder Access Control', 'blockive-premium-addon-for-block'); ?></h2>
					<p><?php esc_html_e('Select user roles allowed to design and edit site templates (Headers, Footers, Single, Archives, Popups). Administrators always have full access.', 'blockive-premium-addon-for-block'); ?></p>
				</div>
			</div>
			<div class="bpafb-card-body">
				<?php
				// With no role switched on, every role that can edit posts
				// has access - the switches alone would suggest nobody has.
				$status_open = __('Everyone who can edit posts has access. Switch on roles below to limit access to only those roles.', 'blockive-premium-addon-for-block');
				$status_limited = __('Only Administrators and the roles switched on below have access.', 'blockive-premium-addon-for-block');
				?>
				<p class="bpafb-roles-status" id="bpafb-roles-status" role="status" data-open="<?php echo esc_attr($status_open); ?>" data-limited="<?php echo esc_attr($status_limited); ?>">
					<span class="dashicons dashicons-info-outline" aria-hidden="true"></span>
					<span class="bpafb-roles-status-text"><?php echo esc_html($allowed ? $status_limited : $status_open); ?></span>
				</p>
				<fieldset>
					<legend class="screen-reader-text"><?php esc_html_e('User Roles', 'blockive-premium-addon-for-block'); ?></legend>
					<div class="bpafb-roles-grid<?php echo $allowed ? '' : ' is-open'; ?>" id="bpafb-roles-grid">
						<div class="bpafb-role-card" style="background: var(--bpafb-slate-50); border-style: dashed;">
							<div class="bpafb-role-info">
								<h3><?php esc_html_e('Administrator', 'blockive-premium-addon-for-block'); ?></h3>
								<p><?php esc_html_e('Full template & site tools access', 'blockive-premium-addon-for-block'); ?></p>
							</div>
							<span style="font-size: 11px; font-weight: 700; color: var(--bpafb-primary); background: var(--bpafb-primary-light); padding: 4px 10px; border-radius: var(--bpafb-radius-full);">
								<?php esc_html_e('Always Enabled', 'blockive-premium-addon-for-block'); ?>
							</span>
						</div>
						<?php foreach (wp_roles()->roles as $slug => $role) : ?>
							<?php
							if ('administrator' === $slug || empty($role['capabilities']['edit_posts'])) {
								continue;
							}
							$is_checked = in_array($slug, $allowed, true);
							?>
							<div class="bpafb-role-card">
								<div class="bpafb-role-info">
									<h3><?php echo esc_html(translate_user_role($role['name'])); ?></h3>
									<p><?php printf(esc_html__('Role slug: %s', 'blockive-premium-addon-for-block'), esc_html($slug)); ?></p>
									<span class="bpafb-role-default"><?php esc_html_e('Has access (default)', 'blockive-premium-addon-for-block'); ?></span>
								</div>
								<label class="bpafb-switch" title="<?php printf(esc_attr__('Toggle access for %s', 'blockive-premium-addon-for-block'), esc_attr($role['name'])); ?>">
									<input type="checkbox" name="<?php echo esc_attr(self::OPTION); ?>[]" value="<?php echo esc_attr($slug); ?>" <?php checked($is_checked); ?>>
									<span class="bpafb-slider"></span>
								</label>
							</div>
						<?php endforeach; ?>
					</div>
				</fieldset>
			</div>
		</div>
		<script>
		( function () {
			var grid = document.getElementById( 'bpafb-roles-grid' );
			var status = document.getElementById( 'bpafb-roles-status' );
			if ( ! grid || ! status ) {
				return;
			}
			var text = status.querySelector( '.bpafb-roles-status-text' );
			grid.addEventListener( 'change', function () {
				var open = ! grid.querySelector( 'input[type="checkbox"]:checked' );
				grid.classList.toggle( 'is-open', open );
				text.textContent = status.getAttribute( open ? 'data-open' : 'data-limited' );
			} );
		} )();
		</script>
		<?php
	}
}
