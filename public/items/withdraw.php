<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Withdraw Item';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    $item = find_item_by_id($id);

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
