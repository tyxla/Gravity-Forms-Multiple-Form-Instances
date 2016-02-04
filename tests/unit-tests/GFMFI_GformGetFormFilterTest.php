<?php

class GFMFI_GformGetFormFilterTest extends WP_UnitTestCase {

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
	public function testGformInitSpinner() {
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
	public function testGformConfirmationLoaded() {
		$input = "'gform_confirmation_loaded', [" . $this->form['id'] . ']';
		$expected = "'gform_confirmation_loaded', [" . $this->randomId . ']';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGfApplyRules() {
		$input = 'gf_apply_rules(' . $this->form['id'] . ',';
		$expected = 'gf_apply_rules(' . $this->randomId . ',';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformConfirmationWrapper() {
		$input = 'gform_confirmation_wrapper_' . $this->form['id'];
		$expected = 'gform_confirmation_wrapper_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformsConfirmationMessage() {
		$input = 'gforms_confirmation_message_' . $this->form['id'];
		$expected = 'gforms_confirmation_message_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testGformConfirmationMessage() {
		$input = 'gform_confirmation_message_' . $this->form['id'];
		$expected = 'gform_confirmation_message_' . $this->randomId;
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::gform_get_form_filter
	 */
	public function testIfFormId() {
		$input = 'if(formId == ' . $this->form['id'] . ')';
		$expected = 'if(formId == ' . $this->randomId . ')';
		$actual = $this->gfmfi->gform_get_form_filter( $input, $this->form );

		$this->assertSame( $expected, $actual );
	}

}