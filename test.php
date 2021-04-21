<?php 
require 'db/connection.php';

    $username = "test";
    $password =  password_hash("P@ssw0rd!p", PASSWORD_DEFAULT);
  

    addRecord(array($username,$password,'admin'), array('username','password','role'), 'users');
    header('location:index.php');