<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Withdraw Item';

    $id = $_GET['id'] ?? NULL;

    $user_id = $_SESSION['user_id'];

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    } 

    if (is_post()) {
        $transaction = [];
        $transaction['user_id'] = $user_id ?? '';
        $transaction['item_id'] = $id ?? '';
        $transaction['quantity'] = $_POST['quantity'] ?? '';
        $transaction['transaction_type'] = 'Withdraw' ?? '';
        $transaction['remarks'] = $_POST['remarks'] ?? '';

        $result = withdraw_item($transaction['item_id'], $transaction['quantity']);

        if ($result == true) {
            insert_transaction($transaction);
            redirect_to(url_for('/transactions/index.php'));
        }
    }

    $item = find_item_by_id($id);

    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }       
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="withdraw_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('items/withdraw.php?id=' . h(u($id))); ?>" method="post">
                        <div class="form-group">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control mb-2" name="item_id" value="<?php echo h($id); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="<?php echo h($item['quantity']); ?>" value="1">
                            <small class="text-danger">Available quantity: <?php echo h($item['quantity']); ?></small>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-dark" data-dismiss="modal">Withdraw</button>
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark" data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>

