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

}