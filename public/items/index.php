<?php
    require_once('../../private/init.php');

    require_login();

    $id = $_GET['id'] ?? '';
    
    $page_title = 'Items';

    $items = find_all_items();

    $item_ids = find_all_items_id();
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-1 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-lg-3 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_id">Item ID</label>
                        </div>
                        <select class="custom-select" id="selected_id">
                            <?php
                                while ($item_id = mysqli_fetch_row($item_ids)) {
                                    echo '<option value="' . h($item_id[0]) . '">';
                                    echo h($item_id[0]) . '</option>';
                                }                              
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9 text-center text-md-right">
                    <a href="<?php echo url_for('/items/add.php'); ?>" class="btn btn-primary mb-1"><i class="fa fa-plus"></i> Add</a>
                    <a href="<?php echo url_for('/items/view.php'); ?>" class="btn btn-success mb-1"><i class="far fa-eye"></i> View</a>
                    <a href="<?php echo url_for('/items/replenish.php'); ?>" class="btn btn-info mb-1" ><i class="fas fa-gas-pump"></i> Replenish</a>
                    <a href="<?php echo url_for('/items/withdraw.php'); ?>" class="btn btn-danger mb-1"><i class="far fa-hand-point-up"></i> Withdraw</a>
                </div>
            </div>
        </div>
    </div>
    <div id="items">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Added By</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                while ($item = mysqli_fetch_assoc($items)) { 
                            
                                // Replace user_id to user name
                                $user = find_user_by_id($item['user_id']);

                                // Test if visible is set to 0, do not show item
                                if ($item['visible'] == '0') {
                                    continue;
                                }

                                $added_date = date_create($item['added_date']);
                            ?>
                                <tr>
                                    <td>    <?php echo h($item['item_id']);            ?></td>
                                    <td>    <?php echo h($item['item_name']);          ?></td>
                                    <td>    <?php echo h($item['item_description']);   ?></td>
                                    <td>    <?php echo h($item['quantity']);           ?></td>
                                    <td>    <?php echo h($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                    <td>    <?php echo h(date_format($added_date, 'm/d/Y H:i A'));        ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>   
</div>

<?php mysqli_free_result($items); ?>
<?php include(SHARED_PATH . '/main_footer.php'); ?>