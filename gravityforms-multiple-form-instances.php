<?php
/**
 * Plugin Name: Gravity Forms: Multiple Form Instances
 * Description: Allows multiple instances of the same form to be run on a single page when using AJAX.
 * Version: 1.0
 * License: GPL2
 */

/**
 * The main plugin class.
 */
class Gravity_Forms_Multiple_Form_Instances {

	/**
	 * Constructor.
	 *	
	 * Used to initialize the plugin.
	 *
	 * @access public
	 */
	function __construct() {
		// hook the HTML ID string find & replace functionality
		add_filter('gform_get_form_filter', array($this, 'gform_get_form_filter'), 10, 2);
	}

	/**
	 * Replaces all occurences of the form ID with a new, unique ID.
	 *	
	 * This is where the magic happens.
	 *
	 * @access public
	 *
	 * @param string $form_string The form HTML string.
	 * @param array $form Array with the form settings.
	 * @return string $form_string The modified form HTML string.
	 */
	function gform_get_form_filter($form_string, $form) {
		// if form has been submitted, use the submitted ID, otherwise generate unique ID
		if (isset($_POST['gform_random_id'])) {
			$random_id = $_POST['gform_random_id'];
		} else {
			$random_id = mt_rand();	
		}

		// this is where we keep our unique ID
		$hidden_field = "<input type='hidden' name='gform_field_values' value='' />";

		// define all occurences of the original form ID that wont hurt the form input
		$strings = array(
			"'gform_wrapper_" . $form['id'] . "'" 					=> "'gform_wrapper_" . $random_id . "'",
			"'gf_" . $form['id'] . "'" 								=> "'gf_" . $random_id . "'",
			"'gform_" . $form['id'] . "'" 							=> "'gform_" . $random_id . "'",
			"'gform_ajax_frame_" . $form['id'] . "'" 				=> "'gform_ajax_frame_" . $random_id . "'",
			"#gf_" . $form['id'] . "'" 								=> "#gf_" . $random_id . "'",
			"'gform_fields_" . $form['id'] . "'" 					=> "'gform_fields_" . $random_id . "'",
			"id='field_" . $form['id'] . "_" 						=> "id='field_" . $random_id . "_",
			"for='input_" . $form['id'] . "_" 						=> "for='input_" . $random_id . "_",
			"id='input_" . $form['id'] . "_" 						=> "id='input_" . $random_id . "_",
			"'gform_submit_button_" . $form['id'] . "'" 			=> "'gform_submit_button_" . $random_id . "'",
			'"gf_submitting_' . $form['id'] . '"' 					=> '"gf_submitting_' . $random_id . '"',
			"'gf_submitting_" . $form['id'] . "'" 					=> "'gf_submitting_" . $random_id . "'",
			"#gform_ajax_frame_" . $form['id'] 						=> "#gform_ajax_frame_" . $random_id,
			"#gform_wrapper_" . $form['id'] 						=> "#gform_wrapper_" . $random_id,
			"#gform_" . $form['id'] 								=> "#gform_" . $random_id,
			"trigger('gform_post_render', [" . $form['id'] 			=> "trigger('gform_post_render', [" . $random_id,
			"gformInitSpinner( " . $form['id'] . "," 				=> "gformInitSpinner( " . $random_id . ",",
			"trigger('gform_page_loaded', [" . $form['id'] 			=> "trigger('gform_page_loaded', [" . $random_id,
			"'gform_confirmation_loaded', [" . $form['id'] . "]" 	=> "'gform_confirmation_loaded', [" . $random_id . "]",
			$hidden_field 											=> $hidden_field . "<input type='hidden' name='gform_random_id' value='" . $random_id . "' />",
		);

		// replace all occurences with the new unique ID
		foreach ($strings as $find => $replace) {
			$form_string = str_replace($find, $replace, $form_string);
		}

		return $form_string;
	}

}

// initialize the plugin
global $gravity_forms_multiple_form_instances;
$gravity_forms_multiple_form_instances = new Gravity_Forms_Multiple_Form_Instances();	