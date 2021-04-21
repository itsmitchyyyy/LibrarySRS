<?php

include '../connection.php';

if (isset($_GET['id']) && $_GET['type'] == 'first') {
    $book = getRecord('books','id',$_GET['id']);

    echo json_encode($book);
}