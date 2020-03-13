<?php
    require_once('../../private/init.php');

    $page_title = 'Add Item';

    if (is_post()) {
        $item = [];
        $item['item_name'] = $_POST['item_name'];
        $item['item_description'] = $_POST['description'];
        $item['quantity'] = $_POST['quantity'];
        $item['added_by'] = $_POST['added_by'];

        $sql = "INSERT INTO items ";
        $sql .= "(item_name, item_description, quantity, added_by, added_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . $item['item_name'] . "', ";
        $sql .= "'" . $item['item_description'] . "', ";
        $sql .= "'" . $item['quantity'] . "', ";
        $sql .= "'" . $item['added_by'] . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

    }
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="add_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo WWW_ROOT . '/items/add.php'; ?>" method="post">
                        <h1 class="display-5">Add new item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name">
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
                            <a href="<?php echo WWW_ROOT . '/items/index.php'; ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>