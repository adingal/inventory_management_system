<?php
    /*
    * Add User Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Transactions';

    // Call find all transactions function
    $transactions = find_all_transactions();

    // Call find all transactions id function
    $transaction_ids = find_all_transactions_id();
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div id="id_options" class="col-md-4 col-lg-3 mr-auto mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_item">Transaction ID</label>
                        </div>
                        <select class="custom-select" id="selected_id">

                            <!-- Loop on all transaction id and create options -->
                            <?php
                                while ($transaction_id = mysqli_fetch_row($transaction_ids)) {
                                    echo '<option value="' . h($transaction_id[0]) . '">';
                                    echo h($transaction_id[0]) . '</option>';
                                }

                                // Free up resources
                                mysqli_free_result($transaction_ids);
                            ?>

                        </select>
                    </div> <!-- input-group -->
                </div> <!-- id_options -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- actions -->
    <div id="transactions">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Previous Qty</th>
                                <th>Quantity</th>
                                <th>Remaining Qty</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>User Name</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Loop on all transactions and create row -->
                            <?php 
                                while ($transaction = mysqli_fetch_assoc($transactions)) {

                                    // Find user and replace user_id to their names
                                    $user = find_user_by_id($transaction['user_id']);
                                    $user_name = $user['first_name'] . ' ' . $user['last_name'];

                                    // Find item and replace item_id to their names
                                    // Test if item is still active
                                    $item = find_item_by_id($transaction['item_id']);
                                    if (!$item) {
                                        continue;
                                    }
                                
                                    $item_name = $item['item_name'];
                                    $trans_date = date_create($transaction['transaction_date']);
                                ?>
                                <tr>
                                    <td><?php echo h($transaction['transaction_id']); ?></td>
                                    <td><?php echo h($item_name); ?></td>
                                    <td><?php echo h($transaction['previous_quantity']); ?></td>
                                    <td><?php echo h($transaction['quantity']); ?></td>
                                    <td><?php echo h($transaction['remaining_quantity']); ?></td>
                                    <td><?php echo h($transaction['transaction_type']); ?></td>
                                    <td><?php echo h(date_format($trans_date, 'm/d/Y H:i A')); ?></td>
                                    <td><?php echo h($user_name); ?></td>
                                    <td><?php echo h($transaction['remarks']); ?></td>
                                </tr>
                            <?php
                                }
                                
                                // Free up resources
                                mysqli_free_result($transactions);    
                            ?>

                        </tbody>
                    </table>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- transactions -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>