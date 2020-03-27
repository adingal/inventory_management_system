<?php
    require_once('../../private/init.php');

    $page_title = 'Add Item';

    if (is_post()) {
        $item = [];
        $item['item_name'] = $_POST['item_name'];
        $item['item_description'] = $_POST['description'];
        $item['quantity'] = $_POST['quantity'];
        $item['added_by'] = $_POST['added_by'];

        $result = insert_item($item);

        if ($result === true) {
            redirect_to(url_for('/items/index.php'));
        } else {
            $errors = $result;
        }
    }
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="add_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/add.php'); ?>" method="post">
                        <h1 class="display-5">Add new item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name">
                            <small class="text-danger">
                                <?php
                                    if ($errors['item_name'] ?? '') {
                                        echo $errors['item_name'];
                                    } else if ($errors['item_min'] ?? '') {
                                        echo $errors['item_min'];
                                    }
                                ?>
                            </small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="100">
                        </div>
                        <div class="form-group mb-2">
                            <label for="added_by">Added By</label>
                            <input type="text" class="form-control" name="added_by">
                        </div>
                        <div class="form-group mb-2 text-right">
                            <input type="submit" class="btn btn-dark" value="Add">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>