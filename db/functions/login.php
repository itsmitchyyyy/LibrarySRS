<?php
include '../connection.php';

if(isset($_POST['loginBtn'])) {
    $request = ['username' => $_POST['email'], 'password' => $_POST['password']];

    login($request);
    header("Location: ../../dashboards/admin/");
}