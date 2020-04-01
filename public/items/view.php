<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'View Item';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    $item = find_item_by_id($id);
    $formatted_date = date_format(date_create($item['added_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

    <div id="view_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                        <h1 class="display-5"><?php echo h($item['item_name']); ?></h1>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5" disabled><?php echo h($item['item_description']); ?></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="100" value="<?php echo h($item['quantity']); ?>" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="added_by">Added By</label>
                            <input type="text" class="form-control" name="added_by" <?php echo 'value="' . h($item['added_by']) . '"'; ?> disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="added_date">Added Date</label>
                            <input type="text" class="form-control" name="added_date" <?php echo 'value="' . $formatted_date . '"'; ?> disabled>
                        </div>
                        <div class="form-group mb-2 text-right">
                            <a href="<?php echo url_for('/items/edit.php?id=' . h(u($id))); ?>" class="btn btn-dark">Edit</a>
                            <a href="<?php echo url_for('/items/delete.php?id=' . h(u($id))); ?>" class="btn btn-dark">Delete</a>
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>