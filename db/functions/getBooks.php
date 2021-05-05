<?php

include '../connection.php';

if (isset($_GET['id']) && $_GET['type'] == 'first') {
    $book = getRecord('books','id',$_GET['id']);
    $category = getRecord('categories', 'id', $book['category_id']);

    $data = array_merge($book, array('category' => $category));

    echo json_encode($data);
}

if (isset($_GET['title']) && $_GET['type'] == 'search') {
    $book = searchActiveRecords('books','ddc',$_GET['title']);

    echo json_encode($book);
}

if (isset($_GET['id']) && $_GET['type'] == 'filter') {
    $book = searchActiveRecords('books','category_id',$_GET['id']);

    echo json_encode($book);
}