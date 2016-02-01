<?php

class GFMFI_ConstructTest extends WP_UnitTestCase {

	public function setUp() {
		$this->gfmfi = $this->getMock('Gravity_Forms_Multiple_Form_Instances', null);
	}

	public function tearDown() {
		unset( $this->gfmfi );
	}

	/**
	 * @covers Gravity_Forms_Multiple_Form_Instances::__construct
	 */
	public function testHookRegistered() {
		$this->gfmfi->__construct();

		$this->assertSame( 10, has_filter( 'gform_get_form_filter', array( $this->gfmfi, 'gform_get_form_filter' ) ) );
	}

}