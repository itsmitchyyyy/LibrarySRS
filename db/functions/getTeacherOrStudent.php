<?php

include '../connection.php';

if (isset($_GET['title']) && $_GET['type'] == 'search') {
    $teacher = searchRecordTeacherOrStudent($_GET['role'],$_GET['title']);

    echo json_encode($teacher);
}