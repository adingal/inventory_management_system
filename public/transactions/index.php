<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Transactions';

    $transactions = find_all_transactions();
    $transaction_ids = find_all_transactions_id();
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

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
                            <?php
                                while ($transaction_id = mysqli_fetch_row($transaction_ids)) {
                                    echo '<option value="' . h($transaction_id[0]) . '">';
                                    echo h($transaction_id[0]) . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="transactions">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Transaction ID</th>
                                <th>User Name</th>
                                <th>Item Name</th>
                                <th>Quantity</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while ($transaction = mysqli_fetch_assoc($transactions)) {
                                
                                // Find user and replace user_id to their names
                                $user = find_user_by_id($transaction['user_id']);
                                $user_name = $user['first_name'] . ' ' . $user['last_name'];

                                // Find item and replace item_id to their names
                                $item = find_item_by_id($transaction['item_id']);
                                $item_name = $item['item_name'];
                            ?>
                                <tr>
                                    <td><?php echo h($transaction['transaction_id']); ?></td>
                                    <td><?php echo h($user_name); ?></td>
                                    <td><?php echo h($item_name); ?></td>
                                    <td><?php echo h($transaction['quantity']); ?></td>
                                    <td><?php echo h($transaction['transaction_type']); ?></td>
                                    <td><?php echo h($transaction['transaction_date']); ?></td>
                                    <td><?php echo h($transaction['remarks']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php mysqli_free_result($transactions); ?>
<?php include(SHARED_PATH . '/main_footer.php'); ?>