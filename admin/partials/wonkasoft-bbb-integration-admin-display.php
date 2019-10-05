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

$page_title = get_admin_page_title();
if ( is_admin() ) {
	?>
	<div class="setting-page-wrap wonkasoft-plugin-settings">
		<div class="settings-page-content">

			<h3><?php echo esc_html( $page_title ); ?></h3>

			<div class="message">
				<p>
					Thank you for using Wonkasoft's <?php echo esc_html( $page_title ); ?>, we will show you how to get started.
				</p>
			</div>

			<ul class="nav nav-tabs w-75" id="wonkasoft-plugin-tabs" role="tablist">
			  <li class="nav-item">
				<a class="nav-link active" id="<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_tab" data-toggle="tab" role="tab" aria-controls="<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_panel" href="#<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_panel"><?php echo esc_html( $page_title ); ?></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" id="plugin-instructions" role="tab" aria-controls="" href="#instructions">Instructions</a>
			  </li>
			</ul>

			<div id="<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_content" class="tab-content w-75">
				<div class="tab-pane fade active show" id="<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_panel" role="tabpanel" aria-labelledby="<?php echo esc_attr( preg_replace( '/[- ]/', '_', strtolower( $page_title ) ) ); ?>_tab">
					<div>
						Settings
					</div>
				</div><!-- .tab-pane -->

				<div class="tab-pane fade" id="instructions" role="tabpanel" aria-labelledby="plugin-instructions">
					
					<div class="table-responsive">
						<table class="table table-striped table-collapsed">
							<thead>
								<tr>
									<th colspan="2">
										We have made a tools options area that will allow you to add any custom options you need to store on your WordPress site.
									</th>
								</tr>
								<tr>
									<th>
										Instruction
									</th>
									<th>
										Image
									</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>
										<span>Go to Wonkasoft item on admin menu. Or click <a href="<?php menu_page_url( 'wonkasoft_menu', true ); ?>" class="wonkasoft-tools-option-link" target="_blank">here</a></span>
									</th>
									<td>
										<img src="<?php echo esc_url( WONKASOFT_PLUGIN_IMG_URL . '/tools-options.jpg' ); ?>" />
									</td>
								</tr>
								<tr>
									<th>
										<span>Click the Option + button.</span>
									</th>
									<td>
										<img src="<?php echo esc_url( WONKASOFT_PLUGIN_IMG_URL . '/wonkasoft-tools-options.jpg' ); ?>" />
									</td>
								</tr>
								<tr>
									<th>
										<span>
											Here you can load any custom options that your would like, but you must add the option for this plugin. 
										</span>
										<span>
											API Key option for this plugin should be named: 
										</span>
										<div class="input-group">
											<input id="plugin-name" class="form-control" disabled value="<?php echo esc_html( ucwords( preg_replace( '/[-]/', ' ', WONKASOFT_PLUGIN_SLUG ) ) . ' API Key' ); ?>" /><div class="input-group-append"><button class="btn btn-success"><i id="copy-code" class="fa fa-copy"></i></button></div>
										</div>
									</th>
									<td>
										<img src="<?php echo esc_url( WONKASOFT_PLUGIN_IMG_URL . '/wonkasoft-tools-add-option.jpg' ); ?>" />
									</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div><!-- .tab-pane -->

			</div><!-- .tab-content -->

		</div>
	</div>
	<?php
}
