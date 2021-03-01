<?php
require_once 'assets/php/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | NaeemNoorSoft</title> <!-- Show Title Dynamically*** ucfirst is used to make first latter Capital -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.css" />
    <!-- Bootstrap 4 CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Fontawesome CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css?family=Maven+Pro:400,500,600,700,800,900&display=swap");

        * {
            font-family: "Maven Pro", sans-serif;

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="index.php"><i class="fab fa-accusoft fa-lg"></i>&nbsp;&nbsp; NaeemNoorSoft</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "home.php") ? "active" : ""; ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "profile.php") ? "active" : ""; ?>" href="profile.php"><i class="fas fa-id-card"></i>&nbsp;Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "attendance.php") ? "active" : ""; ?>" href="attendance.php"><i class="fas fa-user-check"></i>&nbsp;Attendance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == "leave.php") ? "active" : ""; ?>" href="leave.php"><i class="fas fa-chalkboard-teacher"></i>&nbsp;Leave Request</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-user-cog"></i>&nbsp;Hi! <?= $fname ?>
                    </a>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item"><i class="fas fa-cog"></i>&nbsp;Setting</a>
                        <div class="dropdown-divider"></div>
                        <a href="assets/php/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>