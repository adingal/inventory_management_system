<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Delete Transaction';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/transactions/index.php'));
    }

    if (is_post()) {
        $result = delete_transaction($id);

        if ($result) {
            redirect_to(url_for('/transactions/index.php'));
        }
    }

    $transaction = find_transaction_by_id($id);

    // Find item and replace item_id to their names
    $item = find_item_by_id($transaction['item_id']);    
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="delete_transaction" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/transactions/delete.php?id=' . h(u($id))); ?>" method="post">
                        <h1 class="display-5">Delete trans...</h1>
                        <div class="form-group">
                            <label for="transaction_id">Transaction ID</label>
                            <input type="text" class="form-control" name="transaction_id" value="<?php echo h($transaction['transaction_id']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="<?php echo h($transaction['withdrawn_quantity']); ?>" disabled>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Delete">
                            <a href="<?php echo url_for('/transactions/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>