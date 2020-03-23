<?php
    require_once('../../private/init.php');

    $page_title = 'View Transactions';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/transactions/index.php'));
    }

    $transaction = find_transaction_by_id($id);
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>