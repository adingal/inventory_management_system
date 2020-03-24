<?php
    require_once('../../private/init.php');

    $page_title = 'Edit Transaction';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/transactions/index.php'));
    }

    $transaction = find_transaction_by_id($id);

    // Find user and replace user_id to their names
    $user = find_user_by_id($transaction['user_id']);

    // Find item and replace item_id to their names
    $item = find_item_by_id($transaction['item_id']);
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="edit_transaction" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h1 class="display-5">Edit trans...</h1>
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input type="text" class="form-control" name="user_name" value="<?php echo h($user['first_name'] . ' ' . $user['last_name']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="<?php echo h($transaction['withdrawn_quantity']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="transaction_date">Transaction Date</label>
                        <input type="text" class="form-control" name="transaction_date" value="<?php echo h($transaction['transaction_date']); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks" cols="30" rows="5"><?php echo h($transaction['remarks']); ?></textarea>
                    </div>
                    <div class="form-group text-right">
                        <a href="<?php echo url_for('/transactions/edit.php?id=' . h(u($id))); ?>" class="btn btn-dark">Edit</a>
                        <a href="<?php echo url_for('/transactions/delete.php?id=' . h(u($id))); ?>" class="btn btn-dark">Delete</a>
                        <a href="<?php echo url_for('/transactions/index.php'); ?>" class="btn btn-dark">Cancel</a>
                    </div>                    
                </div>                
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>