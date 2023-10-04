<?php
/**
 * Plugin Name: Easy Form
 * Description: Easy Form Creation
 * Version: 1.0.0
 * License: GPLv2 or later
 * Author URI: https://abdulazizz.xyz
 * Plugin URI: https://github.com/abdulazizsardar/easyform
 * Author: Wordpress Contributor
 * Text Domain: easyform
 * Domain Path: /languages
 */

defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

define('EASYFORM_VERSION', '1.0.0');
define('EASYFORM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('EASYFORM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('EASYFORM_FILE', __FILE__);
define('EASYFORM_BASENAME', plugin_basename(__FILE__));

//Get Ready Plugin Translation
function easyform_load_textdomain()
{
    load_plugin_textdomain('easyform', false, dirname( plugin_basename(__FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'easyform_load_textdomain');

// Front End CSS
function easyform_enqueue_custom_scripts() {


    wp_enqueue_style('easyform-frontend-style', plugin_dir_url(__FILE__) . 'assets/css/easyform-frontend-main.css', array(), time());


    
}

add_action('wp_enqueue_scripts', 'easyform_enqueue_custom_scripts');


//easyform_data_table_information
function easyform_data_table_information() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'easyform';

    $charset_collate = $wpdb->get_charset_collate();

// SQL query to create the table.
  $sql = "CREATE TABLE $table_name (
    id BIGINT(20) NOT NULL AUTO_INCREMENT,
    amount INT(10) NOT NULL,
    buyer VARCHAR(255) NOT NULL,
    receipt_id VARCHAR(20) NOT NULL,
    items VARCHAR(255) NOT NULL,
    buyer_email VARCHAR(50) NOT NULL,
    buyer_ip VARCHAR(20),
    note TEXT,
    city VARCHAR(20) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    hash_key VARCHAR(255),
    submission_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    entry_by INT(10),
    PRIMARY KEY (id)
) $charset_collate;";


    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}


// Function to insert data into the table during activation
function easyform_activate() {
    easyform_data_table_information();
    include('functions/default-data.php');
}

register_activation_hook(__FILE__, 'easyform_activate');


//easyform_wp_menu 
function easyform_wp_menu(){
   $menu = add_menu_page( __('Easy Form', 'easyform'), __('Easy Form', 'easyform'), 'manage_options','easyform-general-settings', 'easyform_general_settings_page','dashicons-clock',30);

   //added hook to add styles and scripts for Site Offline admin page
    add_action( 'admin_print_styles-' . $menu, 'easyform_wp_script' );
}
add_action('admin_menu', 'easyform_wp_menu');


// Function to retrieve data from the table
function get_easyform_data_table_information() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'easyform';

    $query = "SELECT * FROM $table_name";
    $results = $wpdb->get_results($query);

    return $results;
}

// Function to save the data before deactivation
function easyform_deactivate() {
    // Get all data from the table
    $data_to_save = get_easyform_data_table_information();

    // Save the data in an option before deactivating the plugin
    update_option('easyform_previous_data', $data_to_save);
}

register_deactivation_hook(__FILE__, 'easyform_deactivate');





require_once EASYFORM_PLUGIN_DIR .'functions/script.php';

function easyform_general_settings_page(){  

    
    require_once('backend/content.php');

}

function easyform_display_page(){ 
    $enabled = get_option('easyform_enable', false);
        if ($enabled && !current_user_can('manage_options')){

        $file = EASYFORM_PLUGIN_DIR."output/index.php";
        include($file);
        exit();
        }  
    }

add_action('template_redirect', 'easyform_display_page'); 



// Register the uninstall hook
register_uninstall_hook(__FILE__, 'easyform_uninstall');

// Function to delete the plugin's database table when the plugin is uninstalled
function easyform_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'easyform';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    delete_option('easyform_enable'); // Optionally, delete any other plugin options here
}