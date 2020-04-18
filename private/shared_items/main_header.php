<?php
    $page_title = $page_title ?? '';

    $user_id = $_SESSION['user_id'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alex Dingal">
    <meta name="description" content="inventory management system project">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo url_for('/css/index.css'); ?>">
</head>
<body>
    <nav id="main-header" class="navbar navbar-expand-md navbar-dark bg-dark p-md-0">
        <div class="container">
            <a href="<?php echo url_for('/index.php'); ?>" class="navbar-brand">adingal</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (is_logged_in()) { ?>
                    <div id="navbarNav" class="collapse navbar-collapse flex-column">
                        <div class="d-flex ml-auto py-1 pr-md-1">
                            <a class="nav-link text-light mr-2 p-md-1" href="<?php echo url_for('/users/view.php?id=' . h(u($user_id))); ?>">
                                <i class="fa fa-user"></i> <?php echo h($_SESSION['first_name']); ?>
                            </a>
                            <a class="ml-auto nav-link text-light p-1" href="<?php echo url_for('/logout.php'); ?>">
                                <i class="fa fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a href="<?php echo url_for('/items/index.php'); ?>" class="nav-link">Items</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo url_for('/transactions/index.php'); ?>" class="nav-link">Transactions</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo url_for('/users/index.php'); ?>" class="nav-link">Users</a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
        </div>
    </nav>