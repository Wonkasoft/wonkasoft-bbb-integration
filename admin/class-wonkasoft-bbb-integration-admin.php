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
				'Wonkasoft',
				'manage_options',
				'wonkasoft_menu',
				array( $this, 'wonkasoft_tools_options_page' ),
				WONKASOFT_BBB_INTEGRATION_IMG_PATH . '/wonka-logo-2.svg',
				100
			);

			add_submenu_page(
				'wonkasoft_menu',
				'Wonkasoft Tools Options',
				'Tools Options',
				'manage_options',
				'wonkasoft_menu',
				array( $this, 'wonkasoft_tools_options_page' ),
			);

			$this->wonkasoft_tools_add_options();
			add_action( 'admin_enqueue_scripts', array( $this, 'wonkasoft_tools_options_js' ), 10, 1 );

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
			'name'                  => _x( 'Conferences', 'bbb_conferences' ),
			'singular_name'         => _x( 'Conference', 'bbb_conferences' ),
			'menu_name'             => __( 'Wonkasoft Conferences', 'bbb_conferences' ),
			'name_admin_bar'        => __( 'Wonkasoft Conferences', 'bbb_conferences' ),
			'archives'              => __( 'Conferences Archives', 'bbb_conferences' ),
			'attributes'            => __( 'Conference Attributes', 'bbb_conferences' ),
			'parent_item_colon'     => __( 'Parent Conference:', 'bbb_conferences' ),
			'all_items'             => __( 'All Conferences', 'bbb_conferences' ),
			'add_new_item'          => __( 'Add Conference', 'bbb_conferences' ),
			'add_new'               => __( 'New Conference', 'bbb_conferences' ),
			'new_item'              => __( 'New Conference', 'bbb_conferences' ),
			'edit_item'             => __( 'Edit Conference', 'bbb_conferences' ),
			'update_item'           => __( 'Update Conference', 'bbb_conferences' ),
			'view_item'             => __( 'View Conference', 'bbb_conferences' ),
			'view_items'            => __( 'View Conferences', 'bbb_conferences' ),
			'search_items'          => __( 'Search Conference', 'bbb_conferences' ),
			'not_found'             => __( 'Not found', 'bbb_conferences' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'bbb_conferences' ),
			'featured_image'        => __( 'Conference Image', 'bbb_conferences' ),
			'set_featured_image'    => __( 'Set Conference image', 'bbb_conferences' ),
			'remove_featured_image' => __( 'Remove Conference image', 'bbb_conferences' ),
			'use_featured_image'    => __( 'Use as Conference image', 'bbb_conferences' ),
			'insert_into_item'      => __( 'Insert into Conference', 'bbb_conferences' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Conference', 'bbb_conferences' ),
			'items_list'            => __( 'Conferences list', 'bbb_conferences' ),
			'items_list_navigation' => __( 'Conferences list navigation', 'bbb_conferences' ),
			'filter_items_list'     => __( 'Filter Conferences list', 'bbb_conferences' ),
		);
		$args   = array(
			'label'                => __( 'Conference', 'bbb_conferences' ),
			'description'          => __( 'Conference rooms', 'bbb_conferences' ),
			'labels'               => $labels,
			'supports'             => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'taxonomies'           => array( 'category', 'post_tag' ),
			'register_meta_box_cb' => array( $this, 'wonkasoft_bbb_meta_box' ),
			'hierarchical'         => false,
			'public'               => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'menu_position'        => 100,
			'menu_icon'            => 'dashicons-groups',
			'show_in_admin_bar'    => true,
			'show_in_nav_menus'    => true,
			'can_export'           => true,
			'has_archive'          => true,
			'exclude_from_search'  => false,
			'publicly_queryable'   => true,
			'capability_type'      => 'post',
			'show_in_rest'         => true,

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
	 * Init for the meta box for wonkasoft_conference post type.
	 */
	public function wonkasoft_bbb_meta_box() {

		add_meta_box( 'conference_status_meta_box', 'Conference Status', array( $this, 'wonkasoft_bbb_meta_box_content' ), 'wonkasoft_conference', 'advanced', 'high', null );

	}

	/**
	 * This builds the content for the meta box.
	 *
	 * @param array $post contains an array of the post.
	 * @param array $args may contain args passed.
	 */
	public function wonkasoft_bbb_meta_box_content( $post, $args = null ) {
		// Add nonce for security and authentication.
		wp_nonce_field( 'wonkasoft_conference_save_nonce', 'wonkasoft_conference_status_nonce' );
		$post_id              = $post->ID;
		$post_meta            = ( ! empty( get_post_meta( $post_id, 'conference_status', true ) ) ) ? wp_kses_allowed_html( get_post_meta( $post_id, 'conference_status', true ) ) : null;
		$post_meta_conference = ( ! empty( get_post_meta( $post_id, 'conference_created', false ) ) ) ? wp_kses_allowed_html( get_post_meta( $post_id, 'conference_created', false ) ) : null;

		$post_meta = json_decode( json_encode( $post_meta ) );

		$output = '';

		$output .= '<div id="conference-status">';
		$output .= '<table class="table table-striped table-hover">';
		$output .= '<tbody>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= 'Status:';
		$output .= '</th>';
		$output .= '<td>';
		$output .= '<span>' . $post->post_status . '</span>';
		$output .= '</td>';
		$output .= '</tr>';

		if ( ! empty( $post_meta_conference ) ) {
			$output .= '<tr>';
			$output .= '<th scope="row">';
			$output .= 'Conference info:';
			$output .= '</th>';
			$output .= '<td class="overflow-hidden">';
			ob_start();
				echo "<pre>\n";
				print_r( json_encode( json_decode( array_shift( $post_meta_conference ) )->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) );
				echo "</pre>\n";
			$output .= ob_get_clean();
			$output .= '</td>';
			$output .= '</tr>';
		}

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="meeting_id">meetingID:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<pre><code>' . $post->ID . '</code></pre>';
		$output .= '<input type="hidden" value="meeting-' . $post->ID . '" id="meeting_id" name="conference_meetingID" />';
		$output .= '<span class="field-description">A meeting ID that can be used to identify this meeting by the 3rd-party application.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="name">name:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="name" name="conference_name" value="' . $post_meta->name . '" />';
		$output .= '<span class="field-description">A name for the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="attendee_pw">attendeePW:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="attendee_pw" name="conference_attendeePW" value="' . $post_meta->attendeePW . '" />';
		$output .= '<span class="field-description">The password that the join URL can later provide as its password parameter to indicate the user will join as a viewer.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="moderator_pw">moderatorPW:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="moderator_pw" name="conference_moderatorPW" value="' . $post_meta->moderatorPW . '" />';
		$output .= '<span class="field-description">The password that will join URL can later provide as its password parameter to indicate the user will as a moderator.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="welcome">welcome:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="welcome" name="conference_welcome" value="' . $post_meta->welcome . '" />';
		$output .= '<span class="field-description">A welcome message that gets displayed on the chat window when the participant joins.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="dial_number">dialNumber:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="dial_number" name="conference_dialNumber" value="' . $post_meta->dialNumber . '" />';
		$output .= '<span class="field-description">The dial access number that participants can call in using regular phone.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="voice_bridge">voiceBridge:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="voice_bridge" name="conference_voiceBridge" value="' . $post_meta->voiceBridge . '" />';
		$output .= '<span class="field-description">Voice conference number that participants enter to join the voice conference. The default pattern for this is a 5-digit number. This is the PIN that a dial-in user must enter to join the conference.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="web_voice">webVoice:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="web_voice" name="conference_webVoice" value="' . $post_meta->webVoice . '" />';
		$output .= '<span class="field-description">Voice conference alphanumeric that participants enter to join the voice conference.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output          .= '<tr>';
		$output          .= '<th scope="row">';
		$output          .= '<label for="max_participants">maxParticipants:</label>';
		$output          .= '</th>';
		$output          .= '<td class="input-group">';
		$max_participants = ( ! empty( $post_meta->maxParticipants ) ) ? $post_meta->maxParticipants : 20;
		$output          .= '<input type="number" class="form-control" id="max_participants" name="conference_maxParticipants" value="' . $max_participants . '
		" />';
		$output          .= '<span class="field-description">Set the maximum number of users allowed to joined the conference at the same time.</span>';
		$output          .= '</td>';
		$output          .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="logout_url">logoutURL:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="logout_url" name="conference_logoutURL" value="' . $post_meta->logoutURL . '" />';
		$output .= '<span class="field-description">The URL that the BigBlueButton client will go to after users click the OK button on the ‘You have been logged out message’.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="record">record:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="record" name="conference_record" value="' . $post_meta->record . '" />';
		$output .= '<span class="field-description">Setting ‘record=true’ instructs the BigBlueButton server to record the media and events in the session for later playback.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output  .= '<tr>';
		$output  .= '<th scope="row">';
		$output  .= '<label for="duration">duration:</label>';
		$output  .= '</th>';
		$output  .= '<td class="input-group">';
		$duration = ( ! empty( $post_meta->duration ) ) ? $post_meta->duration : 600;
		$output  .= '<input type="number" class="form-control" id="duration" name="conference_duration" value="' . $duration . '" />';
		$output  .= '<span class="field-description">The maximum length (in minutes) for the meeting.</span>';
		$output  .= '</td>';
		$output  .= '</tr>';

		$output     .= '<tr>';
		$output     .= '<th scope="row">';
		$output     .= '<label for="is_breakout">isBreakout:</label>';
		$output     .= '</th>';
		$output     .= '<td class="input-group form-check">';
		$output     .= '<label class="form-check-label field-description">Must be set to true to create a breakout room.';
		$is_breakout = ( ! empty( $post_meta->isBreakout ) ) ? $post_meta->isBreakout : false;
		if ( $is_breakout ) {

			$output .= '<input type="checkbox" class="form-check-input" id="is_breakout" name="conference_isBreakout" value="' . $is_breakout . '" selected />';

		} else {

			$output .= '<input type="checkbox" class="form-check-input" id="is_breakout" name="conference_isBreakout" />';

		}

		$output .= '</label>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="parent_meeting_id">parentMeetingID:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="parent_meeting_id" name="conference_parentMeetingID" value="' . $post_meta->parentMeetingID . '" />';
		$output .= '<span class="field-description">Must be provided when creating a breakout room, the parent room must be running.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="sequence">sequence:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="number" class="form-control" id="sequence" name="conference_sequence" value="' . $post_meta->sequence . '" />';
		$output .= '<span class="field-description">The sequence number of the breakout room.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output   .= '<tr>';
		$output   .= '<th scope="row">';
		$output   .= '<label for="free_join">freeJoin:</label>';
		$output   .= '</th>';
		$output   .= '<td class="input-group form-check">';
		$output   .= '<label class="form-check-label field-description">If set to true, the client will give the user the choice to choose the breakout rooms he wants to join.';
		$free_join = ( ! empty( $post_meta->freeJoin ) ) ? $post_meta->freeJoin : false;
		if ( $is_breakout ) {

			$output .= '<input type="checkbox" class="form-check-input" id="free_join" name="conference_freeJoin" value="' . $post_meta->freeJoin . '" selected />';

		} else {

			$output .= '<input type="checkbox" class="form-check-input" id="free_join" name="conference_freeJoin" />';

		}
		$output .= '</label>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="meta">meta:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="meta" name="conference_meta" value="' . $post_meta->meta . '" />';
		$output .= '<span class="field-description">Examples of the use of the meta parameters are <code>meta_Presenter=Jane%20Doe</code>, <code>meta_category=FINANCE</code>, and <code>meta_TERM=Fall2016</code>.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="moderator_only_message">moderatorOnlyMessage:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="moderator_only_message" name="conference_moderatorOnlyMessage" value="' . $post_meta->moderatorOnlyMessage . '" />';
		$output .= '<span class="field-description">Display a message to all moderators in the public chat.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="auto_start_recording">autoStartRecording:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="auto_start_recording" name="conference_autoStartRecording" value="' . $post_meta->autoStartRecording . '" />';
		$output .= '<span class="field-description">Whether to automatically start recording when first user joins (default false).</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="allow_start_stop_recording">allowStartStopRecording:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="allow_start_stop_recording" name="conference_allowStartStopRecording" value="' . $post_meta->allowStartStopRecording . '" />';
		$output .= '<span class="field-description">Allow the user to start/stop recording. (default true)</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="webcams_only_for_moderator">webcamsOnlyForModerator:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="webcams_only_for_moderator" name="conference_webcamsOnlyForModerator" value="' . $post_meta->webcamsOnlyForModerator . '" />';
		$output .= '<span class="field-description">Setting <code>webcamsOnlyForModerator=true</code> will cause all webcams shared by viewers during this meeting to only appear for moderators</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="logo">logo:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="logo" name="conference_logo" value="' . $post_meta->logo . '" />';
		$output .= '<span class="field-description">Setting <code>logo=http://www.example.com/my-custom-logo.png</code> will replace the default logo in the Flash client.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="banner_text">bannerText:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="banner_text" name="conference_bannerText" value="' . $post_meta->bannerText . '" />';
		$output .= '<span class="field-description">Will set the banner text in the client.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="banner_color">bannerColor:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="banner_color" name="conference_bannerColor" value="' . $post_meta->bannerColor . '" />';
		$output .= '<span class="field-description">Will set the banner background color in the client. The required format is color hex <code>#FFFFFF</code>.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="copyright">copyright:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="copyright" name="conference_copyright" value="' . $post_meta->copyright . '" />';
		$output .= '<span class="field-description">Setting <code>copyright=My custom copyright</code> will replace the default copyright on the footer of the Flash client.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="mute_on_start">muteOnStart:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="mute_on_start" name="conference_muteOnStart" value="' . $post_meta->muteOnStart . '" />';
		$output .= '<span class="field-description">Setting <code>muteOnStart=true</code> will mute all users when the meeting starts.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="allow_mods_to_unmute_users">allowModsToUnmuteUsers:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="allow_mods_to_unmute_users" name="conference_allowModsToUnmuteUsers" value="' . $post_meta->allowModsToUnmuteUsers . '" />';
		$output .= '<span class="field-description">Default <code>allowModsToUnmuteUsers=false</code>. Setting to <code>allowModsToUnmuteUsers=true</code> will allow moderators to unmute other users in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_disable_cam">lockSettingsDisableCam:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_disable_cam" name="conference_lockSettingsDisableCam" value="' . $post_meta->lockSettingsDisableCam . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsDisableCam=false</code>. Setting <code>lockSettingsDisableCam=true</code> will prevent users from sharing their camera in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_disable_mic">lockSettingsDisableMic:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_disable_mic" name="conference_lockSettingsDisableMic" value="' . $post_meta->lockSettingsDisableMic . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsDisableMic=false</code>. Setting to <code>lockSettingsDisableMic=true</code> will only allow user to join listen only.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_disable_private_chat">lockSettingsDisablePrivateChat:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_disable_private_chat" name="conference_lockSettingsDisablePrivateChat" value="' . $post_meta->lockSettingsDisablePrivateChat . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsDisablePrivateChat=false</code>. Setting to <code>lockSettingsDisablePrivateChat=true</code> will disable private chats in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_disable_public_chat">lockSettingsDisablePublicChat:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_disable_public_chat" name="conference_lockSettingsDisablePublicChat" value="' . $post_meta->lockSettingsDisablePublicChat . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsDisablePublicChat=false</code>. Setting to <code>lockSettingsDisablePublicChat=true</code> will disable public chat in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_disable_note">lockSettingsDisableNote:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_disable_note" name="conference_lockSettingsDisableNote" value="' . $post_meta->lockSettingsDisableNote . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsDisableNote=false</code>. Setting to <code>lockSettingsDisableNote=true</code> will disable notes in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_locked_layout">lockSettingsLockedLayout:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_locked_layout" name="conference_lockSettingsLockedLayout" value="' . $post_meta->lockSettingsLockedLayout . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsLockedLayout=false</code>. Setting to <code>lockSettingsLockedLayout=true</code> will lock the layout in the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_lock_on_join">lockSettingsLockOnJoin:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_lock_on_join" name="conference_lockSettingsLockOnJoin" value="' . $post_meta->lockSettingsLockOnJoin . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsLockOnJoin=false</code>. Setting to <code>lockSettingsLockOnJoin=true</code> will not apply lock setting to users when they join.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="lock_settings_lock_on_join_configurable">lockSettingsLockOnJoinConfigurable:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="lock_settings_lock_on_join_configurable" name="conference_lockSettingsLockOnJoinConfigurable" value="' . $post_meta->lockSettingsLockOnJoinConfigurable . '" />';
		$output .= '<span class="field-description">Default <code>lockSettingsLockOnJoinConfigurable=false</code>. Setting to <code>lockSettingsLockOnJoinConfigurable=true</code> will allow applying of <code>lockSettingsLockOnJoin</code> param.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '<tr>';
		$output .= '<th scope="row">';
		$output .= '<label for="guest_policy">guestPolicy:</label>';
		$output .= '</th>';
		$output .= '<td class="input-group">';
		$output .= '<input type="text" class="form-control" id="guest_policy" name="conference_guestPolicy" value="' . $post_meta->guestPolicy . '" />';
		$output .= '<span class="field-description">Default <code>guestPolicy=ALWAYS_ACCEPT</code>. Will set the guest policy for the meeting. The guest policy determines whether or not users who send a join request with <code>guest=true</code> will be allowed to join the meeting.</span>';
		$output .= '</td>';
		$output .= '</tr>';

		$output .= '</tbody>';
		$output .= '</table>';
		$output .= '</div>';

		echo wp_kses(
			$output,
			array(
				'div'   => array(
					'id'    => array(),
					'class' => array(),
				),
				'pre'   => array(
					'class' => array(),
				),
				'code'  => array(
					'id'    => array(),
					'class' => array(),
				),
				'span'  => array(
					'id'    => array(),
					'class' => array(),
				),
				'table' => array(
					'class' => array(),
				),
				'tbody' => array(
					'class' => array(),
				),
				'tr'    => array(
					'class' => array(),
				),
				'th'    => array(
					'class'   => array(),
					'colspan' => array(),
					'scope'   => array(),
				),
				'td'    => array(
					'class'   => array(),
					'colspan' => array(),
				),
				'label' => array(
					'for'   => array(),
					'class' => array(),
				),
				'input' => array(
					'id'       => array(),
					'name'     => array(),
					'class'    => array(),
					'type'     => array(),
					'value'    => array(),
					'required' => array(),
					'selected' => array(),
				),
			)
		);
	}

	/**
	 * This fires when post is saved.
	 *
	 * @param  int $post_id contains ID of current post.
	 */
	public function wonkasoft_bbb_meta_box_content_save_post( $post_id ) {

		if ( ! isset( $_POST['wonkasoft_conference_status_nonce'] ) || ! wp_verify_nonce( wp_kses_post( wp_unslash( $_POST['wonkasoft_conference_status_nonce'] ) ), 'wonkasoft_conference_save_nonce' ) ) {
				return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		$passed = $_POST;
		$data   = array();

		foreach ( $passed as $key => $value ) {
			if ( strpos( $key, 'conference_' ) !== false && 'wonkasoft_conference_status_nonce' !== $key ) {
				$new_key          = str_replace( 'conference_', '', $key );
				$data[ $new_key ] = $value;
			}
		}

		if ( ! empty( $data ) ) {
			update_post_meta( $post_id, 'conference_status', $data );
			if ( 'publish' === get_post_status( $post_id ) ) {

				$bbb_init   = new Wonkasoft_BBB_Integration_Api( $data );
				$conference = $bbb_init->bbb_create();

				$conference = json_encode( $conference );
				update_post_meta( $post_id, 'conference_created', $conference );
			} else {

				$bbb_init   = new Wonkasoft_BBB_Integration_Api( $data );
				$is_running = $bbb_init->bbb_is_meeting_running();
				$is_running = json_decode( json_encode( $is_running ) );
					update_post_meta( $post_id, 'conference_current', $is_running );
				if ( $is_running->running ) {

					$conference = $bbb_init->bbb_end_meeting();

					$conference = json_encode( $conference );
					update_post_meta( $post_id, 'conference_current', $conference );
				}
			}
		}
	}

		/**
		 * Addition of apera-bags theme options.
		 */
	public function wonkasoft_tools_add_options() {

		$registered_options = ( ! empty( get_option( 'custom_options_added' ) ) ) ? get_option( 'custom_options_added' ) : array();

		if ( ! empty( $registered_options ) ) {
			foreach ( $registered_options as $key => $current_option ) :
				if ( empty( $current_option['id'] ) ) :
					unset( $registered_options[ $key ] );
				endif;
			endforeach;

			foreach ( $registered_options as $register_option ) {
				if ( '' !== $register_option['id'] ) {
					$set_args = array(
						'type'              => 'string',
						'description'       => $register_option['description'],
						'sanitize_callback' => array( $this, 'wonkasoft_tools_options_sanitize' ),
						'show_in_rest'      => false,
					);

					register_setting( 'wonkasoft-tools-options-group', $register_option['id'], $set_args );
				}
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
				<div id="wonkasoft-tools-options">

					<div class="container-fluid">
						<div class="row">
							<div class="col-12 title-column">
							<?php
							$title_text = get_admin_page_title();
							?>
								<h3><?php echo wp_kses_post( $title_text ); ?></h3>
							</div>
						</div>
						<div class="row">
							<div class="col-12 options column">
								<div class="card">
									<div class="card-title">
										<h3><?php esc_html_e( 'Add an option', 'Wonkasoft_Bbb_Integration' ); ?></h3>
										<button type="button" id="wonkasoft_option_add" class="btn wonka-btn btn-success" data-toggle="modal" data-target="#add_option_modal">Option <i class="fa fa-plus"></i></button>
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

										$this->wonkasoft_tool_option_parse(
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
									'wonkasoft_tools_options_ajax_post',
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

				</div><!-- #wonkasoft-tools-options -->
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

		elseif ( strpos( strtolower( $field['description'] ), 'url', 0 ) !== false || strpos( strtolower( $field['api'] ), 'url', 0 ) !== false ) :

			$place_holder = ' placeholder="Paste url here..."';

		else :

			$place_holder = ' placeholder="Paste api key..."';

		endif;

			$output .= '<div class="input-group">';

		if ( strpos( strtolower( $field['description'] ), 'url', 0 ) !== false || strpos( strtolower( $field['api'] ), 'url', 0 ) !== false ) :

			$output .= '<input type="text" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" ' . $styles_set . implode( ' ', $custom_attributes ) . ' value="' . esc_attr( $field['value'] ) . '"' . $place_holder . ' /> ';

		else :

			$output .= '<input type="password" id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" ' . $styles_set . implode( ' ', $custom_attributes ) . ' value="' . esc_attr( $field['value'] ) . '"' . $place_holder . ' /> ';

		endif;

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

		if ( preg_match( '/[wonkasoft]/', $page ) ) :
			wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', array(), '4.1.3', 'all' );

			wp_style_add_data( 'bootstrap', array( 'integrity', 'crossorigin' ), array( 'sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T', 'anonymous' ) );

			wp_enqueue_script( 'bootstrap-popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', array( 'jquery' ), '4.1.3', true );

			wp_script_add_data( 'bootstrap-popper-js', array( 'integrity', 'crossorigin' ), array( 'sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49', 'anonymous' ) );

			wp_enqueue_script( 'bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array( 'jquery' ), '4.1.3', true );

			wp_script_add_data( 'bootstrapjs', array( 'integrity', 'crossorigin' ), array( 'sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM', 'anonymous' ) );

			wp_enqueue_script( 'wonkasoft-tools-options-js', WONKASOFT_PLUGIN_URL . 'includes/js/wonkasoft-tools-options-js.js', array( 'jquery' ), '20190819', true );
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
