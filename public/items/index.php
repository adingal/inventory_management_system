<?php
    require_once('../../private/init.php');

    $page_title = 'Items';

    $sql = "SELECT * FROM items";

    $items = mysqli_query($db, $sql);
    confirm_result_set($items);
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_item">Item ID</label>
                        </div>
                        <select class="custom-select" id="selected_item">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9 text-center text-md-right">
                    <a href="<?php echo WWW_ROOT . '/items/add.php'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="<?php echo WWW_ROOT . '/items/edit.php'; ?>" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a href="<?php echo WWW_ROOT . '/items/delete.php'; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div id="items">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Added By</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($item = mysqli_fetch_assoc($items)) { ?>
                                <tr>
                                    <td><?php echo $item['item_id']; ?></td>
                                    <td><?php echo $item['item_name']; ?></td>
                                    <td><?php echo $item['item_description']; ?></td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo $item['added_by']; ?></td>
                                    <td><?php echo $item['added_date']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>