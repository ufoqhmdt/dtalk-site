<?php

class The7_Core_Compatibility {

	/**
	 * Remove theme options for backwars compatibility.
	 */
	static public function hide_modules_options() {
		remove_filter( 'presscore_options_files_to_load', array( 'The7PT_Admin', 'add_module_options' ) );
	}

}