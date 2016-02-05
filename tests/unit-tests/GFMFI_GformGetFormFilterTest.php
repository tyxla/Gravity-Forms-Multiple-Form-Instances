<?php

class GFMFI_GformGetFormFilterTest extends WP_UnitTestCase {

	public function gform_multiple_instances_strings( $strings ) {
		$strings['fooBar'] = 'barFoo';
		return $strings;
	}

	public function setUp() {
		$this->gfmfi = $this->getMock('Gravity_Forms_Multiple_Form_Instances', null);
		$this->form = array( 'id' => 123 );
		$this->randomId = mt_rand();

		$_POST['gform_random_id'] = $this->randomId;
	}

	public function tearDown() {
		unset( $this->gfmfi );
		unset( $this->form );
		unset( $this->randomId );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testOriginalFormIdAddition() {
		$input = ' gform_wrapper ';
		$expected = ' gform_wrapper gform_wrapper_original_id_' . $this->form['id'] . ' ';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testForChoiceReplacement() {
		$input = "<label for='choice_123'>";
		$expected = "<label for='choice_" . $this->randomId . "_123'>";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdChoiceReplacement() {
		$input = "<label id='choice_123'>";
		$expected = "<label id='choice_" . $this->randomId . "_123'>";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdLabelReplacement() {
		$input = "<label id='label_123'>";
		$expected = "<label id='label_" . $this->randomId . "_123'>";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformWrapperReplacement() {
		$input = "'gform_wrapper_" . $this->form['id'] . "'";
		$expected = "'gform_wrapper_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfReplacement() {
		$input = "'gf_" . $this->form['id'] . "'";
		$expected = "'gf_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformReplacement() {
		$input = "'gform_" . $this->form['id'] . "'";
		$expected = "'gform_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformAjaxFrameReplacement() {
		$input = "'gform_ajax_frame_" . $this->form['id'] . "'";
		$expected = "'gform_ajax_frame_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testHashGfReplacement() {
		$input = "#gf_" . $this->form['id'] . "'";
		$expected = "#gf_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformFieldsReplacement() {
		$input = "'gform_fields_" . $this->form['id'] . "'";
		$expected = "'gform_fields_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdFieldReplacement() {
		$input = "id='field_" . $this->form['id'] . '_';
		$expected = "id='field_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testForInputReplacement() {
		$input = "for='input_" . $this->form['id'] . '_';
		$expected = "for='input_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdInputReplacement() {
		$input = "id='input_" . $this->form['id'] . '_';
		$expected = "id='input_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformSubmitButtonReplacement() {
		$input = "'gform_submit_button_" . $this->form['id'] . "'";
		$expected = "'gform_submit_button_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfSubmittingDoubleQuoteReplacement() {
		$input = '"gf_submitting_' . $this->form['id'] . '"';
		$expected = '"gf_submitting_' . $this->randomId . '"';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfSubmittingSingleQuoteReplacement() {
		$input = "'gf_submitting_" . $this->form['id'] . "'";
		$expected = "'gf_submitting_" . $this->randomId . "'";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testHashGformAjaxFrameReplacement() {
		$input = '#gform_ajax_frame_' . $this->form['id'];
		$expected = '#gform_ajax_frame_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testHashGformWrapperReplacement() {
		$input = '#gform_wrapper_' . $this->form['id'];
		$expected = '#gform_wrapper_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testHashGformReplacement() {
		$input = '#gform_' . $this->form['id'];
		$expected = '#gform_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testTriggerGformPostRenderReplacement() {
		$input = "trigger('gform_post_render', [" . $this->form['id'];
		$expected = "trigger('gform_post_render', [" . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformInitSpinnerReplacement() {
		$input = 'gformInitSpinner( ' . $this->form['id'] . ',';
		$expected = 'gformInitSpinner( ' . $this->randomId . ',';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testTriggerGformPageLoadedReplacement() {
		$input = "trigger('gform_page_loaded', [" . $this->form['id'];
		$expected = "trigger('gform_page_loaded', [" . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformConfirmationLoadedReplacement() {
		$input = "'gform_confirmation_loaded', [" . $this->form['id'] . ']';
		$expected = "'gform_confirmation_loaded', [" . $this->randomId . ']';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfApplyRulesReplacement() {
		$input = 'gf_apply_rules(' . $this->form['id'] . ',';
		$expected = 'gf_apply_rules(' . $this->randomId . ',';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformConfirmationWrapperReplacement() {
		$input = 'gform_confirmation_wrapper_' . $this->form['id'];
		$expected = 'gform_confirmation_wrapper_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformsConfirmationMessageReplacement() {
		$input = 'gforms_confirmation_message_' . $this->form['id'];
		$expected = 'gforms_confirmation_message_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformConfirmationMessageReplacement() {
		$input = 'gform_confirmation_message_' . $this->form['id'];
		$expected = 'gform_confirmation_message_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIfFormIdReplacement() {
		$input = 'if(formId == ' . $this->form['id'] . ')';
		$expected = 'if(formId == ' . $this->randomId . ')';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testWindowGfFormConditionalLogicReplacement() {
		$input = "window['gf_form_conditional_logic'][" . $this->form['id'] . ']';
		$expected = "window['gf_form_conditional_logic'][" . $this->randomId . ']';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testTriggerGformPostConditionalLogicReplacement() {
		$input = "trigger('gform_post_conditional_logic', [" . $this->form['id'] . ',';
		$expected = "trigger('gform_post_conditional_logic', [" . $this->randomId . ',';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformShowPasswordStrengthInputReplacement() {
		$input = 'gformShowPasswordStrength("input_' . $this->form['id'] . '_';
		$expected = 'gformShowPasswordStrength("input_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformInitChosenFieldsInputReplacement() {
		$input = "gformInitChosenFields('#input_" . $this->form['id'] . '_';
		$expected = "gformInitChosenFields('#input_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testJqueryHashInputReplacement() {
		$input = "jQuery('#input_" . $this->form['id'] . '_';
		$expected = "jQuery('#input_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformsCalendarIconInputReplacement() {
		$input = 'gforms_calendar_icon_input_' . $this->form['id'] . '_';
		$expected = 'gforms_calendar_icon_input_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdGinputBasePriceReplacement() {
		$input = "id='ginput_base_price_" . $this->form['id'] . '_';
		$expected = "id='ginput_base_price_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIdGinputQuantityReplacement() {
		$input = "id='ginput_quantity_" . $this->form['id'] . '_';
		$expected = "id='ginput_quantity_" . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfieldPriceReplacement() {
		$input = 'gfield_price_' . $this->form['id'] . '_';
		$expected = 'gfield_price_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfieldQuantityReplacement() {
		$input = 'gfield_quantity_' . $this->form['id'] . '_';
		$expected = 'gfield_quantity_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfieldProductReplacement() {
		$input = 'gfield_product_' . $this->form['id'] . '_';
		$expected = 'gfield_product_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGinputTotalReplacement() {
		$input = 'ginput_total_' . $this->form['id'];
		$expected = 'ginput_total_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfCalcReplacement() {
		$input = 'GFCalc(' . $this->form['id'] . ',';
		$expected = 'GFCalc(' . $this->randomId . ',';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfGlobalNumberFormatsReplacement() {
		$input = 'gf_global["number_formats"][' . $this->form['id'] . ']';
		$expected = 'gf_global["number_formats"][' . $this->randomId . ']';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformNextButtonReplacement() {
		$input = 'gform_next_button_' . $this->form['id'] . '_';
		$expected = 'gform_next_button_' . $this->randomId . '_';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testHiddenFieldAddition() {
		$input = "<input type='hidden' name='gform_field_values'";
		$expected = "<input type='hidden' name='gform_random_id' value='" . $this->randomId . "' />" . $input;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformMultipleInstancesStringsFilter() {
		add_filter( 'gform_multiple_instances_strings', array($this, 'gform_multiple_instances_strings') );

		$input = "fooBar";
		$expected = "barFoo";
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );

		remove_filter( 'gform_multiple_instances_strings', array($this, 'gform_multiple_instances_strings') );
	}

}