<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

function easyform_wp_script()

{
	wp_enqueue_style('easyform-general-settings', EASYFORM_PLUGIN_URL. 'assets/css/easyform_general_settings.css');
}
