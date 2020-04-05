<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Add Item';

    $user_id = $_SESSION['user_id'] ?? '';

    $user = find_user_by_id($user_id);

    if (is_post()) {
        $item = [];
        $item['item_name'] = $_POST['item_name'];
        $item['item_description'] = $_POST['description'];
        $item['quantity'] = $_POST['quantity'];
        $item['user_id'] = $user_id;

        $result = insert_item($item);

        if ($result === true) {
            $transaction = [];
            $transaction['user_id'] = $user_id ?? '';
            $transaction['item_id'] = mysqli_insert_id($db) ?? '';
            $transaction['quantity'] = $item['quantity'] ?? '';
            $transaction['transaction_type'] = 'Add' ?? '';
            $transaction['remarks'] = $_POST['remarks'] ?? '';

            insert_transaction($transaction);
            redirect_to(url_for('/items/index.php'));
        } else {
            $errors = $result;
        }
    } else {
        $item = [];
        $item['item_name'] = '';
        $item['item_description'] = '';
        $item['quantity'] = '';
        $item['user_id'] = '';        
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
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']);?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['item_name'] ?? '') {
                                        echo $errors['item_name'];
                                    } else if ($errors['item_min'] ?? '') {
                                        echo $errors['item_min'];
                                    } else if ($errors['item_max'] ?? '') {
                                        echo $errors['item_max'];
                                    }
                                ?>
                            </small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5"><?php echo h($item['item_description']);?></textarea>
                            <small class="text-danger">
                                <?php
                                    if ($errors['description_max'] ?? '') {
                                        echo $errors['description_max'];
                                    } else if ($errors['description_min'] ?? '') {
                                        echo $errors['description_min'];
                                    }
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="100" value="<?php echo h($item['quantity']);?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['quantity'] ?? '') {
                                        echo $errors['quantity'];
                                    }
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                        </div>                        
                        <div class="form-group mb-2">
                            <label for="user_id">Added By</label>
                            <input type="text" class="form-control" name="user_id" <?php echo 'value="' . h($user['first_name'] . ' ' . $user['last_name']) . '"'; ?> disabled>
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