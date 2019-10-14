<?php
/**
 * This file contains the class for the bbb integration.
 *
 * @link       https://wonkasoft.com
 * @since      1.0.0
 *
 * @package    Wonkasoft_Bbb_Integration
 * @subpackage Wonkasoft_Bbb_Integration/includes
 */

defined( 'ABSPATH' ) || exit;

/**
 * Wonkasofts Big Blue Button integration api class.
 */
class Wonkasoft_BBB_Integration_Api {

	/**
	 * To load api url.
	 *
	 * @var string
	 */
	public $api_url = '';

	/**
	 * To load api call name.
	 *
	 * @var string
	 */
	public $call_name = '';

	/**
	 * To api shared secret.
	 *
	 * @var string
	 */
	public $shared_secret = '';

	/**
	 * A name for the meeting.
	 * Optional
	 *
	 * Setting: name
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * A meeting ID that can be used to identify this meeting by the 3rd-party application.
	 * Required
	 *
	 * Setting: meetingID
	 *
	 * @var string
	 */
	public $meeting_id = '';

	/**
	 * The password that the join URL can later provide as its password parameter to indicate the user will join as a viewer.
	 * Optional (recommended)
	 *
	 * Setting: attendeePW
	 *
	 * @var string
	 */
	public $attendee_pw = '';

	/**
	 * The password that will join URL can later provide as its password parameter to indicate the user will as a moderator.
	 * Optional (recommended)
	 *
	 * Setting: moderatorPW
	 *
	 * @var string
	 */
	public $moderator_pw = '';

	/**
	 * A welcome message that gets displayed on the chat window when the participant joins.
	 * Optional
	 *
	 * Setting: welcome
	 *
	 * @var string
	 */
	public $welcome = '';

	/**
	 * The dial access number that participants can call in using regular phone.
	 * Optional
	 *
	 * Setting: dialNumber
	 *
	 * @var string
	 */
	public $dial_number = '';

	/**
	 * Voice conference number that participants enter to join the voice conference.
	 * The default pattern for this is a 5-digit number. This is the PIN that a dial-in user must enter to join the conference.
	 * Optional
	 *
	 * Setting: voiceBridge
	 *
	 * @var string
	 */
	public $voice_bridge = '';

	/**
	 * Voice conference alphanumeric that participants enter to join the voice conference.
	 * Optional
	 *
	 * Setting: webVoice
	 *
	 * @var string
	 */
	public $web_voice = '';

	/**
	 * Set the maximum number of users allowed to joined the conference at the same time.
	 * Optional
	 *
	 * Setting: maxParticipants
	 *
	 * @var Number
	 */
	public $max_participants = 20;

	/**
	 * The URL that the BigBlueButton client will go to after users click the OK button on the ‘You have been logged out message’.
	 * Optional
	 *
	 * Setting: logoutURL
	 *
	 * @var String
	 */
	public $logout_url = '';

	/**
	 * Setting ‘record=true’ instructs the BigBlueButton server to record the media and events in the session for later playback.
	 * The default is false.
	 * Optional
	 *
	 * Setting: record
	 *
	 * @var Boolean
	 */
	public $record = null;

	/**
	 * The maximum length (in minutes) for the meeting.
	 * Optional
	 *
	 * Setting: duration
	 *
	 * @var Number
	 */
	public $duration = null;

	/**
	 * Must be set to true to create a breakout room.
	 * Required(Breakout Room)
	 *
	 * Setting: isBreakout
	 *
	 * @var Boolean
	 */
	public $is_breakout = null;

	/**
	 * Must be provided when creating a breakout room, the parent room must be running.
	 * Required(Breakout Room)
	 *
	 * Setting: parentMeetingID
	 *
	 * @var String
	 */
	public $parent_meeting_id = '';

	/**
	 * The sequence number of the breakout room.
	 * Optional
	 *
	 * Setting: sequence
	 *
	 * @var String
	 */
	public $sequence = null;

	/**
	 * If set to true, the client will give the user the choice to choose the breakout rooms he wants to join.
	 * Required(Breakout Room)
	 *
	 * Setting: freeJoin
	 *
	 * @var Boolean
	 */
	public $free_join = null;

	/**
	 * This is a special parameter type (there is no parameter named just meta). Example: array( meta_custom => value ).
	 * Optional
	 *
	 * Setting: meta
	 *
	 * @var array
	 */
	public $meta = array();

	/**
	 * Display a message to all moderators in the public chat.
	 * Optional
	 *
	 * Setting: moderatorOnlyMessage
	 *
	 * @var String
	 */
	public $moderator_only_message = null;

	/**
	 * Whether to automatically start recording when first user joins (default false).
	 * Optional
	 *
	 * Setting: autoStartRecording
	 *
	 * @var Boolean
	 */
	public $auto_start_recording = false;

	/**
	 * Allow the user to start/stop recording. (default true)
	 * Optional
	 *
	 * Setting: allowStartStopRecording
	 *
	 * @var Boolean
	 */
	public $allow_start_stop_recording = true;

	/**
	 * Setting webcamsOnlyForModerator=true will cause all webcams shared by viewers during this meeting to only appear for moderators
	 * (added 1.1).
	 * Optional
	 *
	 * Setting: webcamsOnlyForModerator
	 *
	 * @var Boolean
	 */
	public $webcams_only_for_moderator = null;

	/**
	 * Setting logo=http://www.example.com/my-custom-logo.png will replace the default logo in the Flash client. (added 2.0)
	 * Optional
	 *
	 * Setting: logo
	 *
	 * @var String
	 */
	public $logo = null;

	/**
	 * Will set the banner text in the client. (added 2.0)
	 * Optional.
	 *
	 * Setting: bannerText
	 *
	 * @var String
	 */
	public $banner_text = '';

	/**
	 * Will set the banner background color in the client. The required format is color hex #FFFFFF. (added 2.0)
	 * Optional.
	 *
	 * Setting: bannerColor
	 *
	 * @var String
	 */
	public $banner_color = '';

	/**
	 * Setting copyright=My custom copyright will replace the default copyright on the footer of the Flash client. (added 2.0)
	 * Optional.
	 *
	 * Setting: copyright
	 *
	 * @var String
	 */
	public $copyright = '';

	/**
	 * Setting muteOnStart=true will mute all users when the meeting starts. (added 2.0)
	 * Optional.
	 *
	 * Setting: muteOnStart
	 *
	 * @var Boolean
	 */
	public $mute_on_start = null;

	/**
	 * Default allowModsToUnmuteUsers=false. Setting to allowModsToUnmuteUsers=true will allow moderators to unmute other users in the
	 * meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: allowModsToUnmuteUsers
	 *
	 * @var Boolean
	 */
	public $allow_mods_to_unmute_users = null;

	/**
	 * Default lockSettingsDisableCam=false. Setting lockSettingsDisableCam=true will prevent users from sharing their camera in the meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsDisableCam
	 *
	 * @var Boolean
	 */
	public $lock_settings_disable_cam = null;

	/**
	 * Default lockSettingsDisableMic=false. Setting to lockSettingsDisableMic=true will only allow user to join listen only. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsDisableMic
	 *
	 * @var Boolean
	 */
	public $lock_settings_disable_mic = null;

	/**
	 * Default lockSettingsDisablePrivateChat=false. Setting to lockSettingsDisablePrivateChat=true will disable private chats in the meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsDisablePrivateChat
	 *
	 * @var Boolean
	 */
	public $lock_settings_disable_private_chat = null;

	/**
	 * Default lockSettingsDisablePublicChat=false. Setting to lockSettingsDisablePublicChat=true will disable public chat in the meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsDisablePublicChat
	 *
	 * @var Boolean
	 */
	public $lock_settings_disable_public_chat = null;

	/**
	 * Default lockSettingsDisableNote=false. Setting to lockSettingsDisableNote=true will disable notes in the meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsDisableNote
	 *
	 * @var Boolean
	 */
	public $lock_settings_disable_note = null;

	/**
	 * Default lockSettingsLockedLayout=false. Setting to lockSettingsLockedLayout=true will lock the layout in the meeting. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsLockedLayout
	 *
	 * @var Boolean
	 */
	public $lock_settings_locked_layout = null;

	/**
	 * Default lockSettingsLockOnJoin=true. Setting to lockSettingsLockOnJoin=false will not apply lock setting to users when they join. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsLockOnJoin
	 *
	 * @var Boolean
	 */
	public $lock_settings_lock_on_join = null;

	/**
	 * Default lockSettingsLockOnJoinConfigurable=false. Setting to lockSettingsLockOnJoinConfigurable=true will allow applying of lockSettingsLockOnJoin param. (added 2.2)
	 * Optional.
	 *
	 * Setting: lockSettingsLockOnJoinConfigurable
	 *
	 * @var Boolean
	 */
	public $lock_settings_lock_on_join_configurable = false;

	/**
	 * Default guestPolicy=ALWAYS_ACCEPT. Will set the guest policy for the meeting. The guest policy determines whether or not users who send a join request with guest=true will be allowed to join the meeting. Possible values are ALWAYS_ACCEPT, ALWAYS_DENY, and ASK_MODERATOR.
	 * Optional.
	 *
	 * Setting: guestPolicy
	 *
	 * @var String
	 */
	public $guest_policy = '';

	/**
	 * The full name that is to be used to identify this user to other conference attendees.
	 * Required
	 *
	 * Setting: fullName
	 *
	 * @var string
	 */
	public $full_name = '';

	/**
	 * The password that this attendee is using. If the moderator password is supplied, he will be given moderator status (and the same for attendee password, etc).
	 * Required
	 *
	 * Setting: password
	 *
	 * @var string
	 */
	public $password = '';

	/**
	 * Third-party apps using the API can now pass createTime parameter (which was created in the create call), BigBlueButton will ensure it matches the ‘createTime’ for the session. If they differ, BigBlueButton will not proceed with the join request. This prevents a user from reusing their join URL for a subsequent session with the same meetingID.
	 * Optional
	 *
	 * Setting: createTime
	 *
	 * @var string
	 */
	public $create_time = '';

	/**
	 * An identifier for this user that will help your application to identify which person this is. This user ID will be returned for this user in the getMeetingInfo API call so that you can check.
	 * Optional
	 *
	 * Setting: userID
	 *
	 * @var string
	 */
	public $user_id = '';

	/**
	 * If you want to pass in a custom voice-extension when a user joins the voice conference using voip. This is useful if you want to collect more info in you Call Detail Records about the user joining the conference. You need to modify your /etc/asterisk/bbb-extensions.conf to handle this new extensions.
	 * Optional
	 *
	 * Setting: webVoiceConf
	 *
	 * @var string
	 */
	public $web_voice_conf = '';

	/**
	 * The token returned by a setConfigXML API call. This causes the BigBlueButton client to load the config.xml associated with the token (not the default config.xml).
	 * Optional
	 *
	 * Setting: configToken
	 *
	 * @var string
	 */
	public $config_token = '';

	/**
	 * The layout name to be loaded first when the application is loaded.
	 * Optional
	 *
	 * Setting: defaultLayout
	 *
	 * @var string
	 */
	public $default_layout = '';

	/**
	 * The link for the user’s avatar to be displayed when displayAvatar in config.xml is set to true.
	 * Optional
	 *
	 * Setting: avatarURL
	 *
	 * @var string
	 */
	public $avatar_url = '';

	/**
	 * The default behaviour of the JOIN API is to redirect the browser to the Flash client when the JOIN call succeeds. There have been requests if it’s possible to embed the Flash client in a “container” page and that the client starts as a hidden DIV tag which becomes visible on the successful JOIN. Setting this variable to FALSE will not redirect the browser but returns an XML instead whether the JOIN call has succeeded or not. The third party app is responsible for displaying the client to the user.
	 * Optional (Experimental)
	 *
	 * Setting: redirect
	 *
	 * @var string
	 */
	public $redirect = '';

	/**
	 * Some third party apps what to display their own custom client. These apps can pass the URL containing the custom client and when redirect is not set to false, the browser will get redirected to the value of clientURL.
	 * Optional (Experimental)
	 *
	 * Setting: clientURL
	 *
	 * @var string
	 */
	public $client_url = '';

	/**
	 * Set to “true” to force the HTML5 client to load for the user.
	 * Optional
	 *
	 * Setting: joinViaHtml5
	 *
	 * @var String
	 */
	public $join_via_html5 = '';

	/**
	 * Set to “true” to indicate that the user is a guest.
	 * Optional
	 *
	 * Setting: guest
	 *
	 * @var String
	 */
	public $guest = '';

	/**
	 * This is the constructor for this class.
	 *
	 * @param array $data contains the passed in parameters.
	 */
	public function __construct( $data = null ) {

		$this->api_url                                 = ( ! empty( get_option( 'bbb_url', true ) ) ) ? esc_url( get_option( 'bbb_url', true ) ) : null;
		$this->shared_secret                           = ( ! empty( get_option( 'wonkasoft_bbb_integration_api_key', true ) ) ) ? wp_unslash( get_option( 'wonkasoft_bbb_integration_api_key', true ) ) : null;
		$this->name                                    = ( ! empty( $data['name'] ) ) ? wp_unslash( $data['name'] ) : null;
		$this->meeting_id                              = ( ! empty( $data['meetingID'] ) ) ? wp_unslash( $data['meetingID'] ) : null;
		$this->attendee_pw                             = ( ! empty( $data['attendeePW'] ) ) ? wp_unslash( $data['attendeePW'] ) : null;
		$this->moderator_pw                            = ( ! empty( $data['moderatorPW'] ) ) ? wp_unslash( $data['moderatorPW'] ) : null;
		$this->welcome                                 = ( ! empty( $data['welcome'] ) ) ? wp_unslash( $data['welcome'] ) : null;
		$this->dial_number                             = ( ! empty( $data['dialNumber'] ) ) ? wp_unslash( $data['dialNumber'] ) : null;
		$this->voice_bridge                            = ( ! empty( $data['voiceBridge'] ) ) ? wp_unslash( $data['voiceBridge'] ) : null;
		$this->web_voice                               = ( ! empty( $data['webVoice'] ) ) ? wp_unslash( $data['webVoice'] ) : null;
		$this->max_participants                        = ( ! empty( $data['maxParticipants'] ) ) ? wp_unslash( $data['maxParticipants'] ) : 20;
		$this->logout_url                              = ( ! empty( $data['logoutURL'] ) ) ? wp_unslash( $data['logoutURL'] ) : null;
		$this->record                                  = ( ! empty( $data['record'] ) ) ? wp_unslash( $data['record'] ) : null;
		$this->duration                                = ( ! empty( $data['duration'] ) ) ? wp_unslash( $data['duration'] ) : null;
		$this->is_breakout                             = ( ! empty( $data['isBreakout'] ) ) ? wp_unslash( $data['isBreakout'] ) : null;
		$this->parent_meeting_id                       = ( ! empty( $data['parentMeetingID'] ) ) ? wp_unslash( $data['parentMeetingID'] ) : null;
		$this->sequence                                = ( ! empty( $data['sequence'] ) ) ? wp_unslash( $data['sequence'] ) : null;
		$this->free_join                               = ( ! empty( $data['freeJoin'] ) ) ? wp_unslash( $data['freeJoin'] ) : null;
		$this->meta                                    = ( ! empty( $data['meta'] ) ) ? wp_unslash( $data['meta'] ) : null;
		$this->moderator_only_message                  = ( ! empty( $data['moderatorOnlyMessage'] ) ) ? wp_unslash( $data['moderatorOnlyMessage'] ) : null;
		$this->auto_start_recording                    = ( ! empty( $data['autoStartRecording'] ) ) ? wp_unslash( $data['autoStartRecording'] ) : null;
		$this->allow_start_stop_recording              = ( ! empty( $data['allowStartStopRecording'] ) ) ? wp_unslash( $data['allowStartStopRecording'] ) : null;
		$this->webcams_only_for_moderator              = ( ! empty( $data['webcamsOnlyForModerator'] ) ) ? wp_unslash( $data['webcamsOnlyForModerator'] ) : null;
		$this->logo                                    = ( ! empty( $data['logo'] ) ) ? wp_unslash( $data['logo'] ) : null;
		$this->banner_text                             = ( ! empty( $data['bannerText'] ) ) ? wp_unslash( $data['bannerText'] ) : null;
		$this->banner_color                            = ( ! empty( $data['bannerColor'] ) ) ? wp_unslash( $data['bannerColor'] ) : null;
		$this->copyright                               = ( ! empty( $data['copyright'] ) ) ? wp_unslash( $data['copyright'] ) : null;
		$this->mute_on_start                           = ( ! empty( $data['muteOnStart'] ) ) ? wp_unslash( $data['muteOnStart'] ) : null;
		$this->allow_mods_to_unmute_users              = ( ! empty( $data['allowModsToUnmuteUsers'] ) ) ? wp_unslash( $data['allowModsToUnmuteUsers'] ) : null;
		$this->lock_settings_disable_cam               = ( ! empty( $data['lockSettingsDisableCam'] ) ) ? wp_unslash( $data['lockSettingsDisableCam'] ) : null;
		$this->lock_settings_disable_mic               = ( ! empty( $data['lockSettingsDisableMic'] ) ) ? wp_unslash( $data['lockSettingsDisableMic'] ) : null;
		$this->lock_settings_disable_private_chat      = ( ! empty( $data['lockSettingsDisablePrivateChat'] ) ) ? wp_unslash( $data['lockSettingsDisablePrivateChat'] ) : null;
		$this->lock_settings_disable_public_chat       = ( ! empty( $data['lockSettingsDisablePublicChat'] ) ) ? wp_unslash( $data['lockSettingsDisablePublicChat'] ) : null;
		$this->lock_settings_disable_note              = ( ! empty( $data['lockSettingsDisableNote'] ) ) ? wp_unslash( $data['lockSettingsDisableNote'] ) : null;
		$this->lock_settings_locked_layout             = ( ! empty( $data['lockSettingsLockedLayout'] ) ) ? wp_unslash( $data['lockSettingsLockedLayout'] ) : null;
		$this->lock_settings_lock_on_join              = ( ! empty( $data['lockSettingsLockOnJoin'] ) ) ? wp_unslash( $data['lockSettingsLockOnJoin'] ) : null;
		$this->lock_settings_lock_on_join_configurable = ( ! empty( $data['lockSettingsLockOnJoinConfigurable'] ) ) ? wp_unslash( $data['lockSettingsLockOnJoinConfigurable'] ) : null;
		$this->guest_policy                            = ( ! empty( $data['guestPolicy'] ) ) ? wp_unslash( $data['guestPolicy'] ) : null;

		$this->full_name      = ( ! empty( $data['fullName'] ) ) ? wp_unslash( $data['fullName'] ) : null;
		$this->password       = ( ! empty( $data['password'] ) ) ? wp_unslash( $data['password'] ) : null;
		$this->create_time    = ( ! empty( $data['createTime'] ) ) ? wp_unslash( $data['createTime'] ) : null;
		$this->user_id        = ( ! empty( $data['userID'] ) ) ? wp_unslash( $data['userID'] ) : null;
		$this->web_voice_conf = ( ! empty( $data['webVoiceConf'] ) ) ? wp_unslash( $data['webVoiceConf'] ) : null;
		$this->config_token   = ( ! empty( $data['configToken'] ) ) ? wp_unslash( $data['configToken'] ) : null;
		$this->default_layout = ( ! empty( $data['defaultLayout'] ) ) ? wp_unslash( $data['defaultLayout'] ) : null;
		$this->avatar_url     = ( ! empty( $data['avatarURL'] ) ) ? wp_unslash( $data['avatarURL'] ) : null;
		$this->redirect       = ( ! empty( $data['redirect'] ) ) ? wp_unslash( $data['redirect'] ) : null;
		$this->client_url     = ( ! empty( $data['clientURL'] ) ) ? wp_unslash( $data['clientURL'] ) : null;
		$this->join_via_html5 = ( ! empty( $data['joinViaHtml5'] ) ) ? wp_unslash( $data['joinViaHtml5'] ) : null;
		$this->guest          = ( ! empty( $data['guest'] ) ) ? wp_unslash( $data['guest'] ) : null;

	}

	/**
	 * This function is for conference creation.
	 *
	 * @return xml returns an xml of the response from server.
	 */
	public function bbb_create() {
		$this->call_name = 'create';

		$query_string = array(
			'name'                               => $this->name,
			'meetingID'                          => $this->meeting_id,
			'attendeePW'                         => $this->attendee_pw,
			'moderatorPW'                        => $this->moderator_pw,
			'welcome'                            => $this->welcome,
			'dialNumber'                         => $this->dial_number,
			'voiceBridge'                        => $this->voice_bridge,
			'webVoice'                           => $this->web_voice,
			'maxParticipants'                    => $this->max_participants,
			'logoutURL'                          => $this->logout_url,
			'record'                             => $this->record,
			'duration'                           => $this->duration,
			'isBreakout'                         => $this->is_breakout,
			'parentMeetingID'                    => $this->parent_meeting_id,
			'sequence'                           => $this->sequence,
			'freeJoin'                           => $this->free_join,
			'moderatorOnlyMessage'               => $this->moderator_only_message,
			'autoStartRecording'                 => $this->auto_start_recording,
			'allowStartStopRecording'            => $this->allow_start_stop_recording,
			'webcamsOnlyForModerator'            => $this->webcams_only_for_moderator,
			'logo'                               => $this->logo,
			'bannerText'                         => $this->banner_text,
			'bannerColor'                        => $this->banner_color,
			'copyright'                          => $this->copyright,
			'muteOnStart'                        => $this->mute_on_start,
			'allowModsToUnmuteUsers'             => $this->allow_mods_to_unmute_users,
			'lockSettingsDisableCam'             => $this->lock_settings_disable_cam,
			'lockSettingsDisableMic'             => $this->lock_settings_disable_mic,
			'lockSettingsDisablePrivateChat'     => $this->lock_settings_disable_private_chat,
			'lockSettingsDisablePublicChat'      => $this->lock_settings_disable_public_chat,
			'lockSettingsDisableNote'            => $this->lock_settings_disable_note,
			'lockSettingsLockedLayout'           => $this->lock_settings_locked_layout,
			'lockSettingsLockOnJoin'             => $this->lock_settings_lock_on_join,
			'lockSettingsLockOnJoinConfigurable' => $this->lock_settings_lock_on_join_configurable,
			'guestPolicy'                        => $this->guest_policy,
		);

		if ( ! empty( $this->meta ) ) {
			foreach ( $this->meta as $key => $value ) {
				$query_string[ $key ] = $value;
			}
		}

		$query_string = json_decode( json_encode( $query_string ) );
		$query_string = http_build_query( $query_string );

		$checksum = hash( 'sha256', $this->call_name . $query_string . $this->shared_secret );

		$ch  = curl_init();
		$url = $this->api_url . $this->call_name . '?' . $query_string . '&checksum=' . $checksum;
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLPROTO_HTTPS, true );

		$response = curl_exec( $ch );

		if ( false === $response ) :
			$error_obj = array(
				'error'  => curl_error( $ch ),
				'status' => 'failed',
				'url'    => $url,
			);

			curl_close( $ch );

			$error_obj = json_decode( json_encode( $error_obj ) );

			return $error_obj;
		else :

			$xml_response   = simplexml_load_string( $response );
			$json_response  = json_encode( $xml_response );
			$array_response = json_decode( $json_response, true );
			$data_obj       = array(
				'response' => $array_response,
				'url'      => $url,
			);

			curl_close( $ch );

			return $data_obj;

		endif;
	}

	/**
	 * This function is for conference join.
	 */
	public function bbb_join() {
		$this->call_name = 'join';

		$query_string = array(
			'fullName'      => $this->full_name,
			'meetingID'     => $this->meeting_id,
			'password'      => $this->password,
			'createTime'    => $this->create_time,
			'userID'        => $this->user_id,
			'webVoiceConf'  => $this->web_voice_conf,
			'configToken'   => $this->config_token,
			'defaultLayout' => $this->default_layout,
			'avatarURL'     => $this->avatar_url,
			'redirect'      => $this->redirect,
			'clientURL'     => $this->client_url,
			'joinViaHtml5'  => $this->join_via_html5,
			'guest'         => $this->guest,
		);

		$query_string = json_decode( json_encode( $query_string ) );
		$query_string = http_build_query( $query_string );

		$checksum = hash( 'sha256', $this->call_name . $query_string . $this->shared_secret );

		$ch  = curl_init();
		$url = $this->api_url . $this->call_name . '?' . $query_string . '&checksum=' . $checksum;
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLPROTO_HTTPS, true );

		$response = curl_exec( $ch );

		if ( false === $response ) :
			$error_obj = array(
				'error'  => curl_error( $ch ),
				'status' => 'failed',
				'url'    => $url,
			);

			curl_close( $ch );

			$error_obj = json_decode( json_encode( $error_obj ) );

			return $error_obj;
		else :

			$xml_response   = simplexml_load_string( $response );
			$json_response  = json_encode( $xml_response );
			$array_response = json_decode( $json_response, true );
			$data_obj       = array(
				'response' => $array_response,
				'url'      => $url,
			);

			curl_close( $ch );

			return $data_obj;

		endif;
	}

	/**
	 * Check if the meeting is running.
	 *
	 * @return array returns the response.
	 */
	public function bbb_is_meeting_running() {
		$this->call_name = 'isMeetingRunning';

		$query_string = array(
			'meetingID' => $this->meeting_id,
		);

		$query_string = json_decode( json_encode( $query_string ) );
		$query_string = http_build_query( $query_string );

		$checksum = hash( 'sha256', $this->call_name . $query_string . $this->shared_secret );

		$ch  = curl_init();
		$url = $this->api_url . $this->call_name . '?' . $query_string . '&checksum=' . $checksum;
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLPROTO_HTTPS, true );

		$response = curl_exec( $ch );

		if ( false === $response ) :
			$error_obj = array(
				'error'  => curl_error( $ch ),
				'status' => 'failed',
				'url'    => $url,
			);

			curl_close( $ch );

			$error_obj = json_decode( json_encode( $error_obj ) );

			return $error_obj;
		else :

			$xml_response   = simplexml_load_string( $response );
			$json_response  = json_encode( $xml_response );
			$array_response = json_decode( $json_response, true );
			$data_obj       = array(
				'response' => $array_response,
				'url'      => $url,
			);

			curl_close( $ch );

			return $data_obj;

		endif;
	}

	/**
	 * This ends the meeting.
	 *
	 * @return array returns the response.
	 */
	public function bbb_end_meeting() {
		$this->call_name = 'end';

		$query_string = array(
			'meetingID' => $this->meeting_id,
			'password'  => $this->moderator_pw,
		);

		$query_string = json_decode( json_encode( $query_string ) );
		$query_string = http_build_query( $query_string );

		$checksum = hash( 'sha256', $this->call_name . $query_string . $this->shared_secret );

		$ch  = curl_init();
		$url = $this->api_url . $this->call_name . '?' . $query_string . '&checksum=' . $checksum;
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, false );
		curl_setopt( $ch, CURLPROTO_HTTPS, true );

		$response = curl_exec( $ch );

		if ( false === $response ) :
			$error_obj = array(
				'error'  => curl_error( $ch ),
				'status' => 'failed',
				'url'    => $url,
			);

			curl_close( $ch );

			$error_obj = json_decode( json_encode( $error_obj ) );

			return $error_obj;
		else :

			$xml_response   = simplexml_load_string( $response );
			$json_response  = json_encode( $xml_response );
			$array_response = json_decode( $json_response, true );
			$data_obj       = array(
				'response' => $array_response,
				'url'      => $url,
			);

			curl_close( $ch );

			return $data_obj;

		endif;
	}
}
