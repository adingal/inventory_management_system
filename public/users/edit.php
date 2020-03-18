<?php
    require_once('../../private/init.php');

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/users/index.php'));
    }

    $user = find_user_by_id($id);
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>