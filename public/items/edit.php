<?php
    require_once('../../private/init.php');

    $page_title = 'Edit Item';
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

<div id="edit_item" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="#" method="post">
                    <h1 class="display-5">Edit item...</h1>
                    <div class="form-group mb-2">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="<?php echo "I am item name."; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="5"><?php echo "I am description."; ?></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" min="1" max="100" value="<?php echo "3"; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="added_by">Added By</label>
                        <input type="text" class="form-control" name="added_by" <?php echo "value=\"Jose Manalo\" disabled"; ?>>
                    </div>
                    <div class="form-group mb-2">
                        <label for="added_date">Added Date</label>
                        <input type="text" class="form-control" name="added_date" <?php echo "value=\"March 10, 2020\" disabled"; ?>>
                    </div>
                    <div class="form-group mb-2 text-right">
                        <input type="submit" class="btn btn-dark" value="Edit">
                        <a href="<?php echo WWW_ROOT . '/items/index.php'; ?>" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>