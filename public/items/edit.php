<?php
    require_once('../../private/init.php');

    $page_title = 'Edit Item';

    $id = $_GET['id'] ?? '';
    
    $item = find_item_by_id($id);
    $formatted_date = date_format(date_create($item['added_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

<div id="edit_item" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="<?php echo url_for('/items/edit.php'); ?>" method="post">
                    <h1 class="display-5">Edit item...</h1>
                    <div class="form-group mb-2">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="<?php echo $item['item_name']; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="5"><?php echo $item['item_description']; ?></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" min="1" max="100" value="<?php echo $item['quantity']; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label for="added_by">Added By</label>
                        <input type="text" class="form-control" name="added_by" <?php echo 'value="' . $item['added_by'] . '" disabled'; ?>>
                    </div>
                    <div class="form-group mb-2">
                        <label for="added_date">Added Date</label>
                        <input type="text" class="form-control" name="added_date" <?php echo 'value="' . $formatted_date . '" disabled'; ?>>
                    </div>
                    <div class="form-group mb-2 text-right">
                        <input type="submit" class="btn btn-dark" value="Edit">
                        <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>