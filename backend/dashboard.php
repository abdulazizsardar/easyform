<?php  if ( ! defined( 'ABSPATH' ) ) exit; ?>

<h2><?php _e('Dashboard Settings', 'easyform'); ?></h2>

<form method="post" action="<?php echo esc_url($form_action_url); ?>" enctype="multipart/form-data">
    <?php
    // Add nonce to the form
    $nonce = wp_create_nonce('easyform_dashboard_nonce');
    ?>
    <input type="hidden" name="easyform_dashboard_nonce_field" value="<?php echo esc_attr($nonce); ?>">
    
    <p>  
        <label for="easyform_enable" ><?php _e('Enable Easyform Mode:', 'easyform'); ?></label>
        <input type="checkbox" id= "easyform_enable" name="easyform_enable" <?php checked($enabled, true); ?>><?php _e('Enable', 'easyform'); ?>
    </p> 
    

    <div class="submit-buttons">
        <?php submit_button(__('Save Settings', 'easyform'), 'primary', 'easyform_settings_submit_tab'); ?>
        
    </div>
</form>
<?php 
function get_newsletter_client_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'easyform';

    $query = "SELECT * FROM $table_name";
    $results = $wpdb->get_results($query);

    return $results;
}
?>
<!-- Add the table to display the data -->
<h2><?php _e('Easyform Client Information', 'easyform'); ?></h2>
<table class="widefat striped">
    <thead>
        <tr>
            <th><?php _e('ID', 'easyform'); ?></th>
            <th><?php _e('Amount', 'easyform'); ?></th>
            <th><?php _e('Client Buyer', 'easyform'); ?></th>
            <th><?php _e('Receipt ID', 'easyform'); ?></th>
            <th><?php _e('Items', 'easyform'); ?></th>
            <th><?php _e('Email', 'easyform'); ?></th>
            <th><?php _e('Buyer IP', 'easyform'); ?></th>
            <th><?php _e('Note', 'easyform'); ?></th>
            <th><?php _e('City', 'easyform'); ?></th>
            <th><?php _e('Phone', 'easyform'); ?></th>
            <th><?php _e('Hashkey', 'easyform'); ?></th>
            <th><?php _e('Time', 'easyform'); ?></th>
            <th><?php _e('Entry By', 'easyform'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Retrieve data from the database
        $client_data = get_newsletter_client_data();

        // Display the data in the table rows
        foreach ($client_data as $data) {
            ?>
            <tr>
                <td><?php echo esc_html($data->id); ?></td>
                <td><?php echo esc_html($data->amount); ?></td>
                <td><?php echo esc_html($data->buyer); ?></td>
                <td><?php echo esc_html($data->receipt_id); ?></td>
                <td><?php echo esc_html($data->items); ?></td>
                <td><?php echo esc_html($data->buyer_email); ?></td>
                <td><?php echo esc_html($data->buyer_ip); ?></td>
                <td><?php echo esc_html($data->note); ?></td>
                <td><?php echo esc_html($data->city); ?></td>
                <td><?php echo esc_html($data->phone); ?></td>
                <td><?php echo esc_html($data->hash_key); ?></td>
                <td><?php echo esc_html($data->submission_time); ?></td>
                <td><?php echo esc_html($data->entry_by); ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<style >
    .submit-buttons {
    text-align: center;
    display: flex;
}

.submit-buttons input[type="submit"] {
    margin-right: 10px;
}

</style>