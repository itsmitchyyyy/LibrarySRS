<?php
function connect() {
    try {
        return new PDO("mysql:host=localhost;dbname=librarysrs","root","");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function login($request) {
    $conn = connect();
    $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->execute([$request['username']]);
    $data = $stmt->fetch();
    
    $conn = null;
    return $data;
}
?>