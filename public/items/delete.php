<?php
    require_once('../../private/init.php');

    $page_title = 'Delete Item';
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="delete_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo WWW_ROOT . '/items/delete.php'; ?>" method="post">
                        <h1 class="display-5">Delete item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control" name="item_id" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" disabled>
                        </div>
                        <div class="form-group mb-2 text-right">
                            <input type="submit" class="btn btn-dark" value="Delete">
                            <a href="<?php echo WWW_ROOT . '/items/index.php'; ?>" class="btn btn-dark">Cancel</a>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>