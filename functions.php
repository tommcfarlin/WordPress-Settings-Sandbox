<?php

/**
 * This function introduces a single theme menu option into the WordPress 'Appearance'
 * menu.
 */
function sandbox_example_theme_menu() {

	add_theme_page(
		'Sandbox Theme', 			// The title to be displayed in the browser window for this page.
		'Sandbox Theme',			// The text to be displayed for this menu item
		'administrator',			// Which type of users can see this menu item
		'sandbox_theme_options',	// The unique ID - that is, the slug - for this menu item
		'sandbox_theme_display'		// The name of the function to call when rendering this menu's page
	);

} // end sandbox_example_theme_menu
add_action( 'admin_menu', 'sandbox_example_theme_menu' );

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function sandbox_theme_display() {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2>Sandbox Theme Options</h2>
		<?php settings_errors(); ?>
		
		<form method="post" action="options.php">
			
			<?php settings_fields( 'sandbox_theme_display_options' ); ?>
			<?php do_settings_sections( 'sandbox_theme_display_options' ); ?>	
			
			<?php settings_fields( 'sandbox_theme_social_options' ); ?>
			<?php do_settings_sections( 'sandbox_theme_social_options' ); ?>	
					
			<?php submit_button(); ?>
		</form>
		
	</div><!-- /.wrap -->
<?php
} // end sandbox_theme_display

/* ------------------------------------------------------------------------ *
 * Setting Registration
 * ------------------------------------------------------------------------ */ 

/**
 * Initializes the theme's display options page by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function sandbox_initialize_theme_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'sandbox_theme_display_options' ) ) {	
		add_option( 'sandbox_theme_display_options' );
	} // end if

	// First, we register a section. This is necessary since all future options must belong to a 
	add_settings_section(
		'general_settings_section',			// ID used to identify this section and with which to register options
		'Display Options',					// Title to be displayed on the administration page
		'sandbox_general_options_callback',	// Callback used to render the description of the section
		'sandbox_theme_display_options'		// Page on which to add this section of options
	);
	
	// Next, we'll introduce the fields for toggling the visibility of content elements.
	add_settings_field(	
		'show_header',						// ID used to identify the field throughout the theme
		'Header',							// The label to the left of the option interface element
		'sandbox_toggle_header_callback',	// The name of the function responsible for rendering the option interface
		'sandbox_theme_display_options',	// The page on which this option will be displayed
		'general_settings_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			'Activate this setting to display the header.'
		)
	);
	
	add_settings_field(	
		'show_content',						
		'Content',				
		'sandbox_toggle_content_callback',	
		'sandbox_theme_display_options',					
		'general_settings_section',			
		array(								
			'Activate this setting to display the content.'
		)
	);
	
	add_settings_field(	
		'show_footer',						
		'Footer',				
		'sandbox_toggle_footer_callback',	
		'sandbox_theme_display_options',		
		'general_settings_section',			
		array(								
			'Activate this setting to display the footer.'
		)
	);
	
	// Finally, we register the fields with WordPress
	register_setting(
		'sandbox_theme_display_options',
		'sandbox_theme_display_options'
	);
	
} // end sandbox_initialize_theme_options
add_action('admin_init', 'sandbox_initialize_theme_options');

/**
 * Initializes the theme's social optoions by registering the Sections,
 * Fields, and Settings.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function sandbox_theme_intialize_social_options() {

	if( false == get_option( 'sandbox_theme_social_options' ) ) {	
		add_option( 'sandbox_theme_social_options' );
	} // end if
	
	add_settings_section(
		'social_settings_section',			// ID used to identify this section and with which to register options
		'Social Options',					// Title to be displayed on the administration page
		'sandbox_social_options_callback',	// Callback used to render the description of the section
		'sandbox_theme_social_options'		// Page on which to add this section of options
	);
	
	add_settings_field(	
		'twitter',						
		'Twitter',							
		'sandbox_twitter_callback',	
		'sandbox_theme_social_options',	
		'social_settings_section'			
	);

	add_settings_field(	
		'facebook',						
		'Facebook',							
		'sandbox_facebook_callback',	
		'sandbox_theme_social_options',	
		'social_settings_section'			
	);
	
	add_settings_field(	
		'googleplus',						
		'Google+',							
		'sandbox_googleplus_callback',	
		'sandbox_theme_social_options',	
		'social_settings_section'			
	);
	
	register_setting(
		'sandbox_theme_social_options',
		'sandbox_theme_social_options',
		'sandbox_theme_sanitize_social_options'
	);
	
} // end sandbox_theme_intialize_social_options
add_action( 'admin_init', 'sandbox_theme_intialize_social_options' );

/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function provides a simple description for the General Options page. 
 *
 * It's called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function sandbox_general_options_callback() {
	echo '<p>Select which areas of content you wish to display.</p>';
} // end sandbox_general_options_callback

/**
 * This function provides a simple description for the Social Options page. 
 *
 * It's called from the 'sandbox_theme_intialize_social_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function sandbox_social_options_callback() {
	echo '<p>Provide the URL to the social networks you\'d like to display.</p>';
} // end sandbox_general_options_callback

/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 

/**
 * This function renders the interface elements for toggling the visibility of the header element.
 * 
 * It accepts an array or arguments and expects the first element in the array to be the description
 * to be displayed next to the checkbox.
 */
function sandbox_toggle_header_callback($args) {
	
	// First, we read the options collection
	$options = get_option('sandbox_theme_display_options');
	
	// Next, we update the name attribute to access this element's ID in the context of the display options array
	// We also access the show_header element of the options collection in the call to the checked() helper function
	$html = '<input type="checkbox" id="show_header" name="sandbox_theme_display_options[show_header]" value="1" ' . checked(1, $options['show_header'], false) . '/>'; 
	
	// Here, we'll take the first argument of the array and add it to a label next to the checkbox
	$html .= '<label for="show_header">&nbsp;'  . $args[0] . '</label>'; 
	
	echo $html;
	
} // end sandbox_toggle_header_callback

function sandbox_toggle_content_callback($args) {

	$options = get_option('sandbox_theme_display_options');
	
	$html = '<input type="checkbox" id="show_content" name="sandbox_theme_display_options[show_content]" value="1" ' . checked(1, $options['show_content'], false) . '/>'; 
	$html .= '<label for="show_content">&nbsp;'  . $args[0] . '</label>'; 
	
	echo $html;
	
} // end sandbox_toggle_content_callback

function sandbox_toggle_footer_callback($args) {
	
	$options = get_option('sandbox_theme_display_options');
	
	$html = '<input type="checkbox" id="show_footer" name="sandbox_theme_display_options[show_footer]" value="1" ' . checked(1, $options['show_footer'], false) . '/>'; 
	$html .= '<label for="show_footer">&nbsp;'  . $args[0] . '</label>'; 
	
	echo $html;
	
} // end sandbox_toggle_footer_callback

function sandbox_twitter_callback() {
	
	// First, we read the social options collection
	$options = get_option( 'sandbox_theme_social_options' );
	
	// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
	$url = '';
	if( isset( $options['twitter'] ) ) {
		$url = $options['twitter'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="twitter" name="sandbox_theme_social_options[twitter]" value="' . $options['twitter'] . '" />';
	
} // end sandbox_twitter_callback

function sandbox_facebook_callback() {
	
	$options = get_option( 'sandbox_theme_social_options' );
	
	$url = '';
	if( isset( $options['facebook'] ) ) {
		$url = $options['facebook'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="facebook" name="sandbox_theme_social_options[facebook]" value="' . $options['facebook'] . '" />';
	
} // end sandbox_facebook_callback

function sandbox_googleplus_callback() {
	
	$options = get_option( 'sandbox_theme_social_options' );
	
	$url = '';
	if( isset( $options['googleplus'] ) ) {
		$url = $options['googleplus'];
	} // end if
	
	// Render the output
	echo '<input type="text" id="googleplus" name="sandbox_theme_social_options[googleplus]" value="' . $options['googleplus'] . '" />';
	
} // end sandbox_googleplus_callback

/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
 /**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function sandbox_theme_sanitize_social_options( $input ) {
	
	// Define the array for the updated options
	$output = array();

	// Loop through each of the options sanitizing the data
	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	
	
	} // end foreach
	
	// Return the new collection
	return apply_filters( 'sandbox_theme_sanitize_social_options', $output, $input );

} // end sandbox_theme_sanitize_social_options


?>