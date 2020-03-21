<?php
    require_once('../../private/init.php');

    $page_title = 'Transactions';

    $transactions = find_all_transactions();
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div id="id_options" class="col-md-4 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_item">Transaction ID</label>
                        </div>
                        <select class="custom-select" id="selected_item">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 text-center text-md-right">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="#" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                                <th>User ID</th>
                                <th>Item ID</th>
                                <th>Withdrawn Quantity</th>
                                <th>Transaction Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($transaction = mysqli_fetch_assoc($transactions)) { ?>
                                <tr>
                                    <td><?php echo h($transaction['transaction_id']); ?></td>
                                    <td><?php echo h($transaction['user_id']); ?></td>
                                    <td><?php echo h($transaction['item_id']); ?></td>
                                    <td><?php echo h($transaction['withdrawn_quantity']); ?></td>
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

<?php include(SHARED_PATH . '/main_footer.php'); ?>