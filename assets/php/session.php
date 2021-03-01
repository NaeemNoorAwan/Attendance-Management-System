<?php

session_start();
require_once 'auth.php';
$cuser = new Auth(); // cuser is Current User

if (!isset($_SESSION['user'])) {
    header('location:index.php');
    die;
}

$cemail = $_SESSION['user']; //Current LoggedIn user Email

$data = $cuser->currentUser($cemail); // Fecthing Details of Current User, currentUser is defined in Auth.php

$cid = $data['id'];
$cname = $data['name'];
$cpass = $data['password'];
$cphone = $data['phone'];
$cgender = $data['gender'];
$cdob = $data['dob'];
$cphoto = $data['photo'];
$created = $data['created_at'];

$reg_date = date('d M Y', strtotime($created));


$verified = $data['verified'];

$fname = strtok($cname, " "); //This will display just First name of the user

if ($verified == 0) {
    $verified = 'Not Verified!';
} else {
    $verified = 'Verified!';
}
