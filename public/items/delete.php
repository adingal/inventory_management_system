<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Delete Item';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    if (is_post()) {
        $result = delete_item($id);
        if ($result) {
            redirect_to(url_for('/items/index.php'));
        }
    }

    $item = find_item_by_id($id);

    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }    
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="delete_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/delete.php?id=' . h(u($id))); ?>" method="post">
                        <h1 class="display-5">Delete item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control" name="item_id" value="<?php echo h($item['item_id']); ?>" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group mb-2 text-right">
                            <input type="submit" class="btn btn-dark" value="Delete">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>