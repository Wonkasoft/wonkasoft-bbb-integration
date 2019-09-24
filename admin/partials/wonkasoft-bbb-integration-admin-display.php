<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Bbb_Integration
 * @subpackage Wonkasoft_Bbb_Integration/admin/partials
 */

defined( 'ABSPATH' ) || exit;

if ( is_admin() ) {
	?>
	<div class="setting-page-wrap">
		<div class="settings-page-content">
			<table class="table">
				<tbody>
					<tr>
						<th>
							<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
						</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<?php
}
