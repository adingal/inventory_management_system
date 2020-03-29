<?php
    require_once('../../private/init.php');

    $page_title = 'Withdraw Item';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
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
                            <input type="text" class="form-control mb-2" name="item_id">
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1">
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

