<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $title = basename($_SERVER['PHP_SELF'], '.php');
    $title = explode('-', $title);
    $title = ucfirst($title[1]);
    ?>
    <title><?= $title; ?> | Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css" />
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- jQuery CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js" defer></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#open-nav').click(function() {
                $(".admin-nav").toggleClass('animate');
            });
        });
    </script>
    <style type="text/css">
        .admin-nav {
            width: 220px;
            min-height: 100vh;
            overflow: hidden;
            background-color: #343a40;
            transition: 0.3s all ease-in-out;
        }

        .admin-link {
            background-color: #343a40;

        }

        .admin-link:hover,
        .nav-active {
            background-color: #212529;
            text-decoration: none;
        }

        .animate {
            width: 0;
            transition: 0.3s all ease-in-out;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="admin-nav p-0">
                <h4 class="text-light text-center p-2">Admin Panel</h4>
                <div class="list-group list-group-flush">

                    <a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? "nav-active" : ""; ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Dashboard</a>
                    <!-- tachometer-alt/chart-pie -->
                    <a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php') ? "nav-active" : ""; ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Users</a>

                    <a href="admin-attendance.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-attendance.php') ? "nav-active" : ""; ?>"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Attendance</a>

                    <a href="admin-leave.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-leave.php') ? "nav-active" : ""; ?>"><i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;Leave Approval</a>

                    <!-- <a href="" class="list-group-item text-light admin-link "><i class="fas fa-table"></i>&nbsp;&nbsp;Export Users</a> -->

                    <a href="#" class="list-group-item text-light admin-link "><i class="fas fa-id-card"></i>&nbsp;&nbsp;Profile</a>

                    <a href="#" class="list-group-item text-light admin-link "><i class="fas fa-cog"></i>&nbsp;&nbsp;Setting</a>

                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-12 bg-primary pt-2 justify-content-between d-flex">
                        <a href="#" class="text-white" id="open-nav">
                            <h3><i class="fas fa-bars"></i></h3>
                        </a>

                        <h4 class="text-light"><?= $title; ?></h4>

                        <a href="assets/php/logout.php" class="text-light mt-1"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>

                    </div>
                </div>