<?php
    if ( ! defined( 'ABSPATH' ) ) exit;
    require_once EASYFORM_PLUGIN_DIR .'backend/essential-variables.php';
  
?>  
                        
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <!-- ==========================
            TITLE 
        =========================== -->
        <title><?php _e("Form Table","easyform") ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="">
        <style>
            body{
                background-color: #f2f2f2;
            }

            /* Style the form container */
            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px 45px 20px 20px;
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            /* Style form labels */
            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }

            /* Style form inputs */
            input[type="text"],
            input[type="email"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            /* Style the submit button */
            input[type="submit"] {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            /* Style the submit button on hover */
            input[type="submit"]:hover {
                background-color: #0056b3;
            }

            /* Style the hash_key input (disabled) */
            input[type="text"][disabled] {
                background-color: #f5f5f5;
                color: #555;
            }

        </style>

    </head>
    <body>
        <div class="container">
            <div class="easyform-page">        
                <!-- Show the NewsLetter  -->
                <?php
                    // Check if the newsletter status is 'on'
                    if ($easyform_newsletter_status === 'on') {

                        ?>
                        <div class="form-submit">
                            <form method="post" id="easyform-form" class="easyform-form">
                                <!-- Add the nonce field here -->
                               
                                <h3><?php _e("Submit Your Form","easyform") ?></h3>

                                <?php
                          

                                if ($easyform_client_amount == 1) {
                                    ?>
                                        <label for="amount"><?php _e('Amount:','easyform'); ?></label>
                                        <input type="text" name="amount" id="amount" required placeholder="2000">
                                    <?php
                                }
                            
                                if ($easyform_client_buyer == 1) {
                                    ?>
                                        <label for="buyer"><?php _e('Buyer:','easyform'); ?></label>
                                        <input type="text" name="buyer" id="buyer" required placeholder="Buyer Name">
                                    <?php
                                }
                               
                                if ($easyform_client_receipt_id  == 1) {
                                    ?>
                                       <label for="receipt_id"> <?php _e('Receipt ID:','easyform'); ?></label>
                                       <input type="number" name="receipt_id" id="receipt_id" required placeholder="335678">
                                    <?php
                                }
                                if ($easyform_client_items == 1) {
                                    ?>
                                        <label for="items"><?php _e('Items:','easyform'); ?></label>
                                        <input type="text" name="items" id="items" required placeholder="Plugin Theme">
                                    <?php
                                }
                               
                                if ($easyform_client_email == 1) {
                                    ?>
                                        <label for="buyer_email"><?php _e('Buyer Email:','easyform'); ?></label>
                                        <input type="email" name="buyer_email" id="buyer_email" required placeholder="yourmail@gmail.com">
                                    <?php
                                }
                                if ($easyform_client_ip == 1) {
                                    ?>
                                        <label for="buyer_ip"><?php _e('Buyer Ip:','easyform'); ?></label>
                                        <input type="number" name="buyer_ip" id="buyer_ip" required placeholder="223344">
                                    <?php
                                }
                                if ($easyform_client_note == 1) {
                                    ?>
                                        
                                    <label for="comment"><?php _e('Your Note:','easyform'); ?></label>
                                    <input type="text" name="note" id="note" required placeholder="Write Some thing your note">
                                    <?php
                                }
                                
                               
                                if ($easyform_client_city == 1) {
                                    ?>
                                        <label for="city"> <?php _e('City:','easyform'); ?></label>
                                        <input type="text" name="city" id="city" required placeholder="Michigan Detroad, USA">
                                    <?php
                                }
                             
                                if ($easyform_client_phone  == 1) {
                                    ?>
                                        <label for="phone"> <?php _e('Phone:','easyform'); ?></label>
                                        <input type="text" name="phone" id="phone" required placeholder="+1 313 682 2324">
                                    <?php
                                }
                              
                                if ($easyform_client_hash_key  == 1) {
                                    ?>
                                        <label for="hash_key"><?php _e('Hash Key (Automatically Generated):','easyform'); ?></label>
                                        <input type="text" name="hash_key" id="hash_key" disabled placeholder="Under Construction">
                                    <?php
                                }
                                if ($easyform_client_entry_by  == 1) {
                                    ?>
                                        <label for="entry_by"><?php _e('Entry By','easyform'); ?></label>
                                        <input type="text" name="entry_by" id="entry_by" placeholder="1234">
                                    <?php
                                }
                     
                                
                                ?>

                                <input type="submit" value="Submit">
                            </form>
      
                        </div>
                        <?php    
                    }
                ?>
            </div>
        </div>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
            global $wpdb;



            // Retrieve the form data
            $amount = '';
            $buyer = '';
            $receipt_id = '';
            $items = '';
            $buyer_email = '';
            $buyer_ip = '';
            $note = '';
            $city = '';
            $phone = '';
            $hash_key = '';
            $entry_by = '';


            // Check if 'Client Data Information is Enable' field is enabled

            if ($easyform_client_amount == 1 && isset($_POST['amount'])) {
                $amount = sanitize_text_field($_POST['amount']);
            }
            if ($easyform_client_buyer == 1 && isset($_POST['buyer'])) {
                $buyer = sanitize_text_field($_POST['buyer']);
            }
            if ($easyform_client_receipt_id == 1 && isset($_POST['receipt_id'])) {
                $receipt_id = absint($_POST['receipt_id']);
            }
            if ($easyform_client_items == 1 && isset($_POST['items'])) {
                $items = sanitize_text_field($_POST['items']);
            }
            if ($easyform_client_email == 1 && isset($_POST['buyer_email'])) {
                $buyer_email = sanitize_email($_POST['buyer_email']);
            }
            if ($easyform_client_ip == 1 && isset($_POST['buyer_ip'])) {
                $buyer_ip = absint($_POST['buyer_ip']);
            }
            if ($easyform_client_note == 1 && isset($_POST['note'])) {
                $note = sanitize_text_field($_POST['note']);
            }
            if ($easyform_client_city == 1 && isset($_POST['city'])) {
                $city = sanitize_text_field($_POST['city']);
            }
            if ($easyform_client_phone == 1 && isset($_POST['phone'])) {
                $phone = sanitize_text_field($_POST['phone']);
            }
            if ($easyform_client_hash_key == 1 && isset($_POST['hash_key'])) {
                $hash_key = sanitize_text_field($_POST['hash_key']);
            }
            if ($easyform_client_entry_by == 1 && isset($_POST['entry_by'])) {
                $entry_by = sanitize_text_field($_POST['entry_by']);
            }

            
            

            // Save the form data to the database
            $table_name = $wpdb->prefix . 'easyform';
            $data = array(
                'amount'=>$amount,
                'buyer'=>$buyer,
                'receipt_id'=>$receipt_id,
                'items'=>$items,
                'buyer_email'=>$buyer_email,
                'buyer_ip'=>$buyer_ip,
                'note'=>$note,
                'city'=>$city,
                'phone'=>$phone,
                'hash_key'=>$hash_key,
                'entry_by'=>$entry_by

            );
            $wpdb->insert($table_name, $data);
                
            }
                
        ?>
                
    </body>
</html>  
     



