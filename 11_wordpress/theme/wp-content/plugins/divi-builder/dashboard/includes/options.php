<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Array of all sections. All sections will be added into sidebar navigation except for the 'header' section.
$all_sections = array(
	'updates'  => array(
		'title'    => esc_html__( 'Updates', 'et_builder_plugin' ),
		'contents' => array(
			'main'   => esc_html__( 'Main', 'bloom' ),
		),
	),
	'api'  => array(
		'title'    => esc_html__( 'API Settings', 'et_builder_plugin' ),
		'contents' => array(
			'main'   => esc_html__( 'Main', 'bloom' ),
		),
	),
);

/**
 * Array of all options
 * General format for options:
 * '<option_name>' => array(
 *							'type' => ...,
 *							'name' => ...,
 *							'default' => ...,
 *							'validation_type' => ...,
 *							etc
 *						)
 * <option_name> - just an identifier to add the option into $assigned_options array
 * Array of parameters may contain diffrent attributes depending on option type.
 * 'type' is the required attribute for all options. All other attributes depends on the option type.
 * 'validation_type' and 'name' are required attribute for the option which should be saved into DataBase.
 *
 */

$dashboard_options_all = array(

	'updates' => array(
		'section_start' => array(
			'type'     => 'section_start',
			'title'    => esc_html__( 'Enable Updates', 'et_builder' ),
			'subtitle' => sprintf( esc_html__( 'Keeping your plugins updated is important. To %1$s for the Divi Builder, you must first authenticate your Elegant Themes account by inputting your account Username and API Key below. Your username is the same username you use when logging into your Elegant Themes account, and your API Key can be found by logging into your account and navigating to the Account > API Key page.', 'et_builder' ),
				sprintf( '<a href="%1$s" target="_blank">%2$s</a>',
					esc_attr( 'http://www.elegantthemes.com/plugins/divi-builder/documentation/update/' ),
					esc_html__( 'enable updates', 'et_builder' )
				)
			),
			'no_escape' => true,
		),

		'option_1' => array(
			'type'                 => 'input_field',
			'subtype'              => 'text',
			'placeholder'          => '',
			'title'                => esc_html__( 'Username:', 'et_builder_plugin' ),
			'name'                 => 'updates_username',
			'class'                => 'updates_option updates_option_username',
			'validation_type'      => 'simple_text',
			'hide_contents'        => true,
			'hint_text'            => esc_html__( 'Please enter your ElegantThemes.com username', 'et_builder_plugin' ),
		),

		'option_2' => array(
			'type'                 => 'input_field',
			'subtype'              => 'text',
			'placeholder'          => '',
			'title'                => esc_html__( 'API Key:', 'et_builder_plugin' ),
			'name'                 => 'updates_api_key',
			'class'                => 'updates_option updates_option_api_key',
			'validation_type'      => 'simple_text',
			'hide_contents'        => true,
			'hint_text'            => sprintf( esc_html__( 'Enter your %1$s here.', 'Monarch' ),
				sprintf( '<a href="%1$s" target="_blank">%2$s</a>',
					esc_attr( 'https://www.elegantthemes.com/members-area/api-key.php' ),
					esc_html__( 'Elegant Themes API Key', 'Monarch' )
				)
			),
		),

		'update_button' => array(
			'type'            => 'button',
			'title'           => esc_html__( 'Save', 'et_builder_plugin' ),
			'link'            => '#',
			'authorize'       => false,
			'class'           => 'et_dashboard_updates_save',
		),
	),

	'google_api' => array(
		'section_start' => array(
			'type'     => 'section_start',
			'title'    => esc_html__( 'Google API', 'et_builder' ),
		),

		'option' => array(
			'type'                 => 'input_field',
			'subtype'              => 'text',
			'placeholder'          => '',
			'title'                => esc_html__( 'Google API Key:', 'et_builder_plugin' ),
			'name'                 => 'google_api_key',
			'class'                => 'google_api_key',
			'validation_type'      => 'simple_text',
			'hide_contents'        => true,
			'hint_text'            => et_get_safe_localization( sprintf( __( 'The Maps module uses the Google Maps API and requires a valid Google API Key to function. Before using the map module, please make sure you have added your API key here. Learn more about how to create your Google API Key <a target="_blank" href="%1$s">here</a>.', 'et_builder_plugin' ), 'http://www.elegantthemes.com/gallery/divi/documentation/map/#gmaps-api-key' ) ),
		),

		'option_maps_script_enqueue' => array(
			'type'                 => 'checkbox',
			'default'              => 'on',
			'value'                => 'on',
			'title'                => esc_html__( 'Enqueue Google Maps Script', 'et_builder_plugin' ),
			'name'                 => 'enqueue_google_maps_script',
			'class'                => 'enqueue_google_maps_script',
			'validation_type'      => 'simple_text',
			'hint_text'            => et_get_safe_localization( sprintf( __( 'Disable this option to remove the Google Maps API script from your Divi Builder Pages. This may improve compatibility with third party plugins that also enqueue this script. Please Note: Modules that rely on the Google Maps API in order to function properly, such as the Maps and Fullwidth Maps Modules, will still be available but will not function while this option is disabled (unless you manually add Google Maps API script).', 'et_builder_plugin' ), 'http://www.elegantthemes.com/gallery/divi/documentation/map/#gmaps-api-key' ) ),
		),
		
		'option_use_google_fonts' => array(
			'type'                 => 'checkbox',
			'default'              => 'on',
			'value'                => 'on',
			'title'                => esc_html__( 'Use Google Fonts', 'et_builder_plugin' ),
			'name'                 => 'use_google_fonts',
			'class'                => 'use_google_fonts',
			'validation_type'      => 'simple_text',
			'hint_text'            => et_get_safe_localization( __( 'Disable this option to remove the Google Fonts from your Divi Builder Pages.', 'et_builder_plugin' ) ),
		),

		'update_button' => array(
			'type'            => 'button',
			'title'           => esc_html__( 'Save', 'et_builder_plugin' ),
			'link'            => '#',
			'authorize'       => false,
			'class'           => 'et_google_api_save',
		),
	),

	'minify_combine_scripts' => array(
		'section_start' => array(
			'type'      => 'section_start',
			'title'     => esc_html__( 'Minify and Combine Javascript Files', 'et_builder' ),
		),
		'option' => array(
			'type'               => 'yes_no_button',
			'options'            => array(
				'on'             => __( 'On', 'et_builder' ),
				'off'            => __( 'Off', 'et_builder' ),
			),
			'default'            => 'on',
			'label'              => esc_html__( 'Minify and Combine Javascript Files', 'et_builder_plugin' ),
			'title'              => esc_html__( 'Minify and Combine Javascript Files', 'et_builder_plugin' ),
			'name'               => 'minify_combine_scripts',
			'class'              => 'minify_combine_scripts',
			'hide_input'         => et_load_unminified_scripts(),
			'hide_input_message' => esc_html__( 'Divi Builder uses uncombined and unminified script because "SCRIPT_DEBUG" constant on wp-config.php has been set to "true". Other plugin can enforce Divi Builder to use uncombined and unminified scripts by filtering "et_load_unminified_scripts" filter as well.', 'et_builder_plugin' ),
			'validation_type'    => 'simple_text',
			'hint_text'          => et_get_safe_localization( __( 'Use combined and minified javascript file for faster page load.', 'et_builder_plugin' ) ),
		),
	),

	'minify_combine_styles' => array(
		'section_start' => array(
			'type'      => 'section_start',
			'title'     => esc_html__( 'Minify and Combine CSS Files', 'et_builder' ),
		),
		'option' => array(
			'type'               => 'yes_no_button',
			'options'            => array(
				'on'             => __( 'On', 'et_builder' ),
				'off'            => __( 'Off', 'et_builder' ),
			),
			'default'            => 'on',
			'label'              => esc_html__( 'Minify and Combine CSS Files', 'et_builder_plugin' ),
			'title'              => esc_html__( 'Minify and Combine CSS Files', 'et_builder_plugin' ),
			'name'               => 'minify_combine_styles',
			'class'              => 'minify_combine_styles',
			'hide_input'         => et_load_unminified_styles(),
			'hide_input_message' => esc_html__( 'Divi Builder uses uncombined and unminified style because "SCRIPT_DEBUG" constant on wp-config.php has been set to "true". Other plugin can enforce Divi Builder to use uncombined and unminified styles by filtering "et_load_unminified_styles" filter as well.', 'et_builder_plugin' ),
			'validation_type'    => 'simple_text',
			'hint_text'          => et_get_safe_localization( __( 'Use combined and minified CSS file for faster page load.', 'et_builder_plugin' ) ),
		),
	),

	'updates_title' => array(
		'type'  => 'main_title',
		'title' => esc_html__( 'Authenticate Your Subscription', 'et_builder_plugin' ),
	),

	'api_title' => array(
		'type'  => 'main_title',
		'title' => esc_html__( 'Configure the API Settings', 'et_builder_plugin' ),
	),

	'minify_combine_scripts_title' => array(
		'type'  => 'main_title',
		'title' => esc_html__( 'Minify and Combine Javascript Files', 'et_builder_plugin' ),
	),

	'minify_combine_styles_title' => array(
		'type'  => 'main_title',
		'title' => esc_html__( 'Minify and Combine CSS Files', 'et_builder_plugin' ),
	),

	'end_of_section' => array(
		'type' => 'section_end',
	),

	'end_of_sub_section' => array(
		'type'        => 'section_end',
		'sub_section' => 'true',
	),
);

/**
 * Array of options assigned to sections. Format of option key is following:
 * 	<section>_<sub_section>_options
 * where:
 *	<section> = $all_sections -> $key
 *	<sub_section> = $all_sections -> $value['contents'] -> $key
 *
 * Note: name of this array shouldn't be changed. $assigned_options variable is being used in ET_Dashboard class as options container.
 */
$assigned_options = array(
	'updates_main_options' => array(
		$dashboard_options_all[ 'updates_title' ],
		$dashboard_options_all[ 'updates' ][ 'section_start' ],
			$dashboard_options_all[ 'updates' ][ 'option_1' ],
			$dashboard_options_all[ 'updates' ][ 'option_2' ],
			$dashboard_options_all[ 'updates' ][ 'update_button' ],
			$dashboard_options_all[ 'end_of_section' ],
	),
	'api_main_options' => array(
		$dashboard_options_all[ 'api_title' ],
		$dashboard_options_all[ 'google_api' ][ 'section_start' ],
			$dashboard_options_all[ 'google_api' ][ 'option' ],
			$dashboard_options_all[ 'google_api' ][ 'option_maps_script_enqueue' ],
			$dashboard_options_all[ 'google_api' ][ 'option_use_google_fonts' ],
			$dashboard_options_all[ 'google_api' ][ 'update_button' ],
			$dashboard_options_all[ 'end_of_section' ],
	),
	'advanced_main_options' => array(
		$dashboard_options_all[ 'minify_combine_scripts_title' ],
		$dashboard_options_all[ 'minify_combine_scripts' ][ 'section_start' ],
			$dashboard_options_all[ 'minify_combine_scripts' ][ 'option' ],
			$dashboard_options_all[ 'end_of_section' ],
		$dashboard_options_all[ 'minify_combine_styles_title' ],
		$dashboard_options_all[ 'minify_combine_styles' ][ 'section_start' ],
			$dashboard_options_all[ 'minify_combine_styles' ][ 'option' ],
			$dashboard_options_all[ 'end_of_section' ],
	),
);