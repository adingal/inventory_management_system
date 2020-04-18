<?php
    /*
    * View Item Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'View Item';

    // Set id
    $id = $_GET['id'] ?? NULL;

    // If id is null
    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    // Call find item by id function
    $item = find_item_by_id($id);

    // If item is empty
    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }

    // Call find user by id function
    $user = find_user_by_id($item['user_id']);

    // Format added date
    $formatted_date = date_format(date_create($item['added_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

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
                            <input type="text" class="form-control" name="added_by" <?php echo 'value="' . h($user['first_name'] . ' ' . $user['last_name']) . '"'; ?> disabled>
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
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- view_item -->

</div> <!-- content-->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>