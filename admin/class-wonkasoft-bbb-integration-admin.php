<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Bbb_Integration
 * @subpackage Wonkasoft_Bbb_Integration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wonkasoft_Bbb_Integration
 * @subpackage Wonkasoft_Bbb_Integration/admin
 * @author     Wonkasoft, LLC <support@wonkasoft.com>
 */
class Wonkasoft_Bbb_Integration_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wonkasoft_Bbb_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Bbb_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wonkasoft-bbb-integration-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wonkasoft_Bbb_Integration_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wonkasoft_Bbb_Integration_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wonkasoft-bbb-integration-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * This sets up the admin menu for Wonkasoft Admin Integration.
	 */
	public function wonkasoft_bbb_init_admin_menu() {
		/**
		* This will check for Wonkasoft Tools Menu, if not found it will make it.
		*/
		global $wonkasoft_bbb_init_page;
		if ( empty( $GLOBALS['admin_page_hooks']['wonkasoft_menu'] ) ) {
			add_menu_page(
				'Wonkasoft Tools Options',
				'Tools Options',
				'manage_options',
				'wonkasoft_menu',
				array( $this, 'wonkasoft_tools_options_page' ),
				WONKASOFT_BBB_INTEGRATION_IMG_PATH . '/wonka-logo-2.svg',
				100
			);

			$this->wonkasoft_tools_add_options();
			add_action( 'admin_enqueue_scripts', array( $this, 'wonkasoft_tools_options_js' ), 10, 1 );
			add_action( 'wp_ajax_nopriv_wonkasoft_plugins_ajax_requests', array( $this, 'wonkasoft_plugins_ajax_requests' ) );
			add_action( 'wp_ajax_wonkasoft_plugins_ajax_requests', array( $this, 'wonkasoft_plugins_ajax_requests' ) );
		}
		/**
		* This creates option page in the settings tab of admin menu
		*/
		$wonkasoft_bbb_init_page = 'wonkasoft_bbb_init_settings_display';
		add_submenu_page(
			'wonkasoft_menu',
			WONKASOFT_BBB_INTEGRATION_NAME,
			WONKASOFT_BBB_INTEGRATION_NAME,
			'manage_options',
			$wonkasoft_bbb_init_page,
			array( $this, 'wonkasoft_bbb_init_settings_display' )
		);

	}

	/**
	 * This is for registering a new post_type.
	 */
	public function wonkasoft_bbb_conference() {

		$labels = array(
			'name'                  => _x( 'Conferences', 'Post Type General Name', 'bbb_conferences' ),
			'singular_name'         => _x( 'Conference', 'Post Type Singular Name', 'bbb_conferences' ),
			'menu_name'             => __( 'Wonkasoft Conferences', 'bbb_conferences' ),
			'name_admin_bar'        => __( 'Post TypeWonkasoft Conferences', 'bbb_conferences' ),
			'archives'              => __( 'Conferences Archives', 'bbb_conferences' ),
			'attributes'            => __( 'Conference Attributes', 'bbb_conferences' ),
			'parent_item_colon'     => __( 'Parent Conference:', 'bbb_conferences' ),
			'all_items'             => __( 'All Conferences', 'bbb_conferences' ),
			'add_new_item'          => __( 'Add New Conference', 'bbb_conferences' ),
			'add_new'               => __( 'Add New Conference', 'bbb_conferences' ),
			'new_item'              => __( 'New Conference', 'bbb_conferences' ),
			'edit_item'             => __( 'Edit Conference', 'bbb_conferences' ),
			'update_item'           => __( 'Update Conference', 'bbb_conferences' ),
			'view_item'             => __( 'View Conference', 'bbb_conferences' ),
			'view_items'            => __( 'View Conferences', 'bbb_conferences' ),
			'search_items'          => __( 'Search Conference', 'bbb_conferences' ),
			'not_found'             => __( 'Not found', 'bbb_conferences' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'bbb_conferences' ),
			'featured_image'        => __( 'Featured Image', 'bbb_conferences' ),
			'set_featured_image'    => __( 'Set featured image', 'bbb_conferences' ),
			'remove_featured_image' => __( 'Remove featured image', 'bbb_conferences' ),
			'use_featured_image'    => __( 'Use as featured image', 'bbb_conferences' ),
			'insert_into_item'      => __( 'Insert into conference', 'bbb_conferences' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Conference', 'bbb_conferences' ),
			'items_list'            => __( 'Conferences list', 'bbb_conferences' ),
			'items_list_navigation' => __( 'Conferences list navigation', 'bbb_conferences' ),
			'filter_items_list'     => __( 'Filter Conferences list', 'bbb_conferences' ),
		);
		$args   = array(
			'label'                 => __( 'Conference', 'bbb_conferences' ),
			'description'           => __( 'Conference rooms', 'bbb_conferences' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 100,
			'menu_icon'             => 'dashicons-groups',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
			'rest_controller_class' => 'Wonkasoft_bbb_conference',
			'rest_base'             => 'Wonkasoft-bbb-conference',
		);
		register_post_type( 'wonkasoft_conference', $args );

	}

	/**
	 * This function is the callback for the admin screen for this plugin.
	 */
	public function wonkasoft_bbb_init_settings_display() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-bbb-integration-admin-display.php';
	}

	/**
	 * Addition of apera-bags theme options.
	 */
	public function wonkasoft_tools_add_options() {

		$registered_options = ( ! empty( get_option( 'custom_options_added' ) ) ) ? get_option( 'custom_options_added' ) : '';

		if ( ! empty( $registered_options ) ) {

			foreach ( $registered_options as $register_option ) {
				$set_args = array(
					'type'              => 'string',
					'description'       => $register_option['description'],
					'sanitize_callback' => 'wonkasoft_tools_options_sanitize',
					'show_in_rest'      => false,
				);

				register_setting( 'wonkasoft-tools-options-group', $register_option['id'], $set_args );
			}
		}
	}

			/**
			 * Used to sanitize the options
			 *
			 * @param  string $option contains the value within the option.
			 * @return string         returns the sanitized option value.
			 */
	public function wonkasoft_tools_options_sanitize( $option ) {
		$option = esc_html( $option );
		return $option;
	}

			/**
			 * This builds the display of the options page.
			 */
	public function wonkasoft_tools_options_page() {
		if ( is_admin() ) {
			?>
					<div class="container">
						<div class="row">
							<div class="col-12 title-column">
								<?php
								$title_text = get_admin_page_title();
								?>
								<h3 class="title-header"><?php echo wp_kses_post( $title_text ); ?></h3>
							</div>
						</div>
						<div class="row">
							<div class="col-12 options column">
								<div class="card w-100">
									<div class="card-title">
										<h3><?php esc_html_e( 'Add an option', 'Wonkasoft_Getresponse_Init' ); ?></h3>
										<button type="button" id="wonkasoft_option_add" class="wonka-btn" data-toggle="modal" data-target="#add_option_modal">Option <i class="fa fa-plus"></i></button>
									</div>
									<div class="card-body">
								<form id="custom-options-form" method="post" action="options.php">

							  <?php settings_fields( 'wonkasoft-tools-options-group' ); ?>

							  <?php do_settings_sections( 'wonkasoft-tools-options-group' ); ?>

								<?php
									$registered_options = ( ! empty( get_option( 'custom_options_added' ) ) ) ? get_option( 'custom_options_added' ) : '';

								if ( ! empty( $registered_options ) ) :
									foreach ( $registered_options as $register_option ) {
										$current_option = ( ! empty( get_option( $register_option['id'] ) ) ) ? get_option( $register_option['id'] ) : '';

										wonkasoft_tool_option_parse(
											array(
												'id'       => $register_option['id'],
												'label'    => $register_option['label'],
												'value'    => $current_option,
												'desc_tip' => true,
												'description' => $register_option['description'],
												'wrapper_class' => 'form-row form-row-full form-group',
												'class'    => 'form-control',
												'api'      => $register_option['api'],
											)
										);
									}
									endif;
								?>
							<div class="submitter">

									  <?php submit_button( 'Save Settings' ); ?>

							</div>
							</form>
									  </div>
								</div><!-- card w-100 -->
							</div>
							<!-- Modal -->
							<div id="add_option_modal" class="modal fade" role="dialog">
							  <div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<h4 class="modal-title">Add Option</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								  </div>
								  <div class="modal-body">
										<div class="input-group mb-3">
											<input class="form-control" type="text" id="new_option_name" name="new_option_name" placeholder="enter option name..." value="" />
										</div>
										<div class="input-group mb-3">
											<input class="form-control" type="text" id="new_option_description" name="new_option_description" placeholder="enter option description..." value="" />
										</div>
										<div class="input-group mb-3">
											<input class="form-control" type="text" id="new_option_api" name="new_option_api" placeholder="whos api..." value="" />
										</div>
									<?php
									wp_nonce_field(
										'theme_options_ajax_post',
										'new_option_nonce',
										true,
										true
									);
									?>
								  </div>
								  <div class="modal-footer">
										<button type="button" class="btn wonka-btn btn-success" data-dismiss="modal" id="add_option_name">Add option <i class="fa fa-plus"></i></button>
								  </div>
								</div>

							  </div>
							</div>
						</div>
					</div>
				<?php
		}
	}

		/**
		 * For the parsing of option fields.
		 *
		 * @param  array $field array of the fields.
		 */
	public function wonkasoft_tool_option_parse( $field ) {

		$field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
		$field['style']         = isset( $field['style'] ) ? $field['style'] : '';
		$field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
		$field['value']         = isset( $field['value'] ) ? $field['value'] : '';
		$field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
		$field['desc_tip']      = isset( $field['desc_tip'] ) ? $field['desc_tip'] : false;
		$styles_set             = ( ! empty( $field['style'] ) ) ? ' style="' . esc_attr( $field['style'] ) . '" ' : '';

		// Custom attribute handling.
		$custom_attributes = array();
		$output            = '';

		if ( ! empty( $field['custom_attributes'] ) && is_array( $field['custom_attributes'] ) ) {
			foreach ( $field['custom_attributes'] as $attribute => $value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $value ) . '"';
			}
		}

		$output .= '<div class="' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '">
				<label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label>';

		if ( ! empty( $field['description'] ) && false !== $field['desc_tip'] ) {
			$output .= '<span class="woocommerce-help-tip" data-toggle="tooltip" data-placement="top" title="' . esc_attr( $field['description'] ) . '"></span>';
		}

		if ( 'ga' === $field['api'] ) :
			$place_holder = ' placeholder="UA-XXXXXX-X"';
		else :
			$place_holder = ' placeholder="Paste api key..."';
		endif;
		$output .= '<div class="input-group">';
		$output .= '<input type="password" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" ' . $styles_set . implode( ' ', $custom_attributes ) . ' value="' . esc_attr( $field['value'] ) . '"' . $place_holder . ' /> ';
		$output .= '<div class="input-group-append">';
		$output .= '<button class="btn wonka-btn btn-danger" type="button" id="remove-' . esc_attr( $field['id'] ) . '"><i class="fa fa-minus"></i></button>';
		$output .= '</div>';
		$output .= '</div>';
		if ( ! empty( $field['description'] ) && false !== $field['desc_tip'] ) {
			$output .= '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
		}

		$output .= '</div>';

		echo wp_kses(
			$output,
			array(
				'label'  => array(
					'for' => array(),
				),
				'input'  => array(
					'class'       => array(),
					'name'        => array(),
					'id'          => array(),
					'type'        => array(),
					'value'       => array(),
					'placeholder' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
				'div'    => array(
					'class' => array(),
				),
				'button' => array(
					'class' => array(),
					'type'  => array(),
					'id'    => array(),
				),
				'i'      => array(
					'class' => array(),
				),
			)
		);
	}

	/**
	 * This is for enqueuing the script for the theme options page only.
	 *
	 * @param  string $page contains the page name.
	 */
	public function wonkasoft_tools_options_js( $page ) {

		if ( 'toplevel_page_wonkasoft_menu' === $page || 'wonkasoft_menu' === $page ) :
			wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), '4.3.1', 'all' );

			wp_style_add_data( 'bootstrap', array( 'integrity', 'crossorigin' ), array( 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'anonymous' ) );

			wp_enqueue_script( 'bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array( 'jquery' ), '4.3.1', true );

			wp_script_add_data( 'bootstrapjs', array( 'integrity', 'crossorigin' ), array( 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM', 'anonymous' ) );

			wp_enqueue_script( 'wonkasoft-tools-options-js', WONKASOFT_BBB_INTEGRATION_URL . '/includes/js/wonkasoft-tools-options-js.js', array( 'jquery' ), '20190819', true );
		endif;
	}

	/**
	 * This initiates the action link on the plugin screen.
	 */
	public function wonkasoft_init_plugin_screen_action_link() {
		add_filter( 'plugin_action_links_' . WONKASOFT_BBB_INTEGRATION_BASENAME, 'wonkasoft_bbb_init_add_settings_link_filter', 10, 1 );
		add_filter( 'plugin_row_meta', 'wonkasoft_bbb_init_add_description_link_filter', 10, 2 );
	}

	/**
	 * This function is the callback ajax requests for this wonkasoft tools.
	 */
	public function wonkasoft_plugins_ajax_requests() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/wonkasoft-plugins-ajax.php';
	}

}
