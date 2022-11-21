<?php
require('user-db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (UserModel::login($username, $password)) {
        $_SESSION['user'] = $username;
        print '<script>window.location.assign("index.php?page=home");</script>';
    } else {
        print '<script>alert("Wrong username or password");</script>';
        print '<script>window.location.assign("index.php?page=home");</script>';
    }
}
?>