<?php

class GFMFI_GlobalVar extends WP_UnitTestCase {

	public function testGlobalVarRegistered() {
		global $gravity_forms_multiple_form_instances;
		
		$this->assertInstanceOf( 'Gravity_Forms_Multiple_Form_Instances', $gravity_forms_multiple_form_instances );
	}

}