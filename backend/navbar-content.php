<?php

if ( ! defined( 'ABSPATH' ) ) exit;

require_once EASYFORM_PLUGIN_DIR .'functions/default-data.php';



$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'dashboard'; // Get the active tab from the URL query parameter

if (isset($_POST['easyform_settings_submit_tab'])) {
$active_tab = isset($_POST['active_tab']) ? $_POST['active_tab'] : $active_tab; // Get the active tab from the submitted form data



switch ($active_tab) {

    case 'dashboard':

        // Verify the nonce for security
        if (isset($_POST['easyform_dashboard_nonce_field']) && wp_verify_nonce($_POST['easyform_dashboard_nonce_field'], 'easyform_dashboard_nonce')) {

            // Update the 'easyform_enable' option
            update_option('easyform_enable', isset($_POST['easyform_enable']));

           

        } else {
            // Nonce verification failed. You can handle the error or log it.
            // Display an error message or take appropriate action.
            echo '<div class="notice notice-error"><p>' . __('Nonce verification failed. Your request cannot be processed.', 'easyform') . '</p></div>';
        }

    break;

                 
}

echo '<div class="notice notice-success"><p>' . __('Settings saved.', 'easyform') . '</p></div>';
}


$form_action_url = add_query_arg(array('tab' => $active_tab), esc_url($_SERVER['REQUEST_URI']));
 require_once('essential-variables.php'); 
?>
<style >

/* CSS for success message */
.notice-success {
    position: absolute;
    right: 0;
    top: 20%;
    left: 50%;
    transform: translateY(-50%);
    opacity: 1;
    background-color: #dff0d8; /* Background color for success message */
    color: #3c763d; /* Text color for success message */
    padding: 10px; /* Padding around the content of the success message */
    height: 50px;
    width: 300px; /* Width of the success message */
    line-height: 1.4; /* Line height for the content of the success message */
    animation-name: slideIn;
    animation-duration: 6s;
}

@keyframes slideIn {
    0% {
        opacity: 0.5;
        transform: translateX(0%) translateY(-50%);
    }
    100% {
        opacity: 1;
        transform: translateX(-50%) translateY(-50%);
    }
}

.notice-error {
    background-color: #f8d7da;
    color: #721c24;
}

/* Add a class to hide the success message */
.notice-hidden {
    display: none;
}

</style>
<script >
    document.addEventListener('DOMContentLoaded', function () {
    // Function to hide the success message after a specified duration (in milliseconds)
    function hideSuccessMessage() {
        var successMessage = document.querySelector('.notice-success');
        if (successMessage) {
            setTimeout(function () {
                successMessage.classList.add('notice-hidden');
            }, 5000); // Change the duration (in milliseconds) as needed
        }
    }

    hideSuccessMessage(); // Call the function to hide the success message after page load
});

</script>