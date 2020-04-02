<?php
    require_once('../../private/init.php');

    $page_title = 'Replenish Item';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    $item = find_item_by_id($id);
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

    <div id="replenish_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/replenish.php' . h(u($id))); ?>">
                        <h1 class="display-5 text-truncate">Replenish Item</h1>
                        <div class="form-group">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control" name="item_id" value="<?php echo h($item['item_id']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Current Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="<?php echo h($item['quantity']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="replenish_quantity">Replenish Quantity</label>
                            <input type="number" class="form-control" name="replenish_quantity" min="1">
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Replenish">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>