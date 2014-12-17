<?php

/**
 * Plugin Name: Gravity Forms Multiple Instances
 * Description: Allows multiple instances of the same form to be run on a single page when using AJAX.
 * Author: tyxla
 * Author URI: https://github.com/tyxla
 * Version: 1.0.4
 * License: GPL2
 */

if (class_exists("GFForms")) {
  GFForms::include_addon_framework();

  class GFMultipleInstances extends GFAddOn {

    protected $_version = "1.0.4";
    protected $_min_gravityforms_version = "1.0";
    protected $_slug = "gravity-forms-multiple-instances";
    protected $_path = "gravityformsmultipleinstances/gravity-forms-multiple-instances.php";
    protected $_full_path = __FILE__;
    protected $_title = "Multiple Gravity Forms";
    protected $_short_title = "Multiple Instances";

    public function init(){
      parent::init();
      add_filter('gform_form_settings', array($this, 'form_multiple_instances'), 10, 2);
      add_filter('gform_pre_form_settings_save', array($this, 'save_form_multiple_instances'));
    }

    public function init_frontend(){
      parent::init_frontend();
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
     public function gform_get_form_filter($form_string, $form) {
       if(!$form['multiple_instances']) {
         return $form_string;
       }
       // if form has been submitted, use the submitted ID, otherwise generate a new unique ID
       if (isset($_POST['gform_random_id'])) {
         $random_id = $_POST['gform_random_id'];
       } else {
         $random_id = mt_rand();	
       }

       // this is where we keep our unique ID
       $hidden_field = "<input type='hidden' name='gform_field_values' value='' />";

       // define all occurences of the original form ID that wont hurt the form input
       $strings = array(
         "for='choice_"                                       => "for='choice_" . $random_id . "_",
         "id='choice_"                                        => "id='choice_" . $random_id . "_",
         "id='label_"                                         => "id='label_" . $random_id . "_",
         "'gform_wrapper_" . $form['id'] . "'"                => "'gform_wrapper_" . $random_id . "'",
         "'gf_" . $form['id'] . "'"                           => "'gf_" . $random_id . "'",
         "'gform_" . $form['id'] . "'"                        => "'gform_" . $random_id . "'",
         "'gform_ajax_frame_" . $form['id'] . "'"             => "'gform_ajax_frame_" . $random_id . "'",
         "#gf_" . $form['id'] . "'"                           => "#gf_" . $random_id . "'",
         "'gform_fields_" . $form['id'] . "'"                 => "'gform_fields_" . $random_id . "'",
         "id='field_" . $form['id'] . "_"                     => "id='field_" . $random_id . "_",
         "for='input_" . $form['id'] . "_"                    => "for='input_" . $random_id . "_",
         "id='input_" . $form['id'] . "_"                     => "id='input_" . $random_id . "_",
         "'gform_submit_button_" . $form['id'] . "'"          => "'gform_submit_button_" . $random_id . "'",
         '"gf_submitting_' . $form['id'] . '"'                => '"gf_submitting_' . $random_id . '"',
         "'gf_submitting_" . $form['id'] . "'"                => "'gf_submitting_" . $random_id . "'",
         "#gform_ajax_frame_" . $form['id']                   => "#gform_ajax_frame_" . $random_id,
         "#gform_wrapper_" . $form['id']                      => "#gform_wrapper_" . $random_id,
         "#gform_" . $form['id']                              => "#gform_" . $random_id,
         "trigger('gform_post_render', [" . $form['id']       => "trigger('gform_post_render', [" . $random_id,
         "gformInitSpinner( " . $form['id'] . ","             => "gformInitSpinner( " . $random_id . ",",
         "trigger('gform_page_loaded', [" . $form['id']       => "trigger('gform_page_loaded', [" . $random_id,
         "'gform_confirmation_loaded', [" . $form['id'] . "]" => "'gform_confirmation_loaded', [" . $random_id . "]",
         $hidden_field                                        => $hidden_field . "<input type='hidden' name='gform_random_id' value='" . $random_id . "' />",
       );

       // allow addons & plugins to add additional find & replace strings
       $strings = apply_filters('gform_multiple_instances_strings', $strings);

       // replace all occurences with the new unique ID
       foreach ($strings as $find => $replace) {
         $form_string = str_replace($find, $replace, $form_string);
       }

       return $form_string;
     }

     function form_multiple_instances($settings, $form) {
       $choices = array('No', 'Yes');
       $options = '';
       foreach($choices as $key => $choice) {
         $selected = $key == rgar($form, 'multiple_instances') ? ' selected="selected"' : '';
         $options .= '<option value="'.$key.'"'.$selected.'>'.$choice.'</option>';
       }
  
       $settings['Multiple Instances']['multiple_instances'] = '
         <tr>
           <th><label for="multiple_instances">Enable multiple instances of this form on one page?</label></th>
           <td>
             <select id="multiple_instances" name="multiple_instances">'.$options.'</select>
           </td>
         </tr>';

       return $settings;
     }

     function save_form_multiple_instances($form) {
       $form['multiple_instances'] = rgpost('multiple_instances');
       return $form;
     }

   }
   new GFMultipleInstances();
}
