<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alex Dingal">
    <meta name="description" content="inventory management system project">
    <title>IMS - Inventory Management System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <nav id="main-header" class="navbar navbar-expand-md navbar-dark bg-dark p-md-0">
        <div class="container">
            <a href="#" class="navbar-brand">adingal</a>

            <?php if (!is_logged_in()) { ?>

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarNav" class="collapse navbar-collapse flex-column">
                    <div class="d-flex ml-auto py-1 pr-md-1">
                        <a class="nav-link text-light mr-2 p-md-1" href="#">
                            <i class="fa fa-user"></i> Username
                        </a>
                        <a class="ml-auto nav-link text-light p-1" href="#">
                            <i class="fa fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Items</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Transactions</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Users</a>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </nav>