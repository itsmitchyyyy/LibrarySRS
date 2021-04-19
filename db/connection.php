<?php
function connect() {
    try {
        return new PDO("mysql:host=localhost;dbname=librarysrs","root","");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function loginAdmin($username, $password) {
    $conn = connect();
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            echo "<script> window.location='dashboards/admin/index.php'; </script>";
        } else {
            echo "<script> window.location = document.referrer + '?e=Invalid Username and Password; </script>";
        }
    }else{
        echo "<script> window.location = document.referrer + '?e=Invalid Username and Password; </script>";
    }
}

function addRecord($data,$fields,$table){
    $conn = connect();
    $flds = implode(",",$fields);
    $val = array();
    foreach($data as $d)
    $val[] = "?";
    $values = implode(",",$val);
    $sql = "INSERT INTO $table($flds) VALUES($values)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);

    return $conn->lastInsertId();
}

function getRecords($table){
    $conn = connect();
    $sql = "SELECT * FROM $table";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll();

    return $row;
}

function getRecord($table, $field, $id) {
    $conn = connect();
    $sql = "SELECT * FROM $table WHERE $field = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function addUser($data, $fields, $table, $fieldCheckData = null) {
    $conn = connect();
    if ($fieldCheckData) {
        $isExist = getRecord($table, 'email', $fieldCheckData[0]);

        if ($isExist) {
            return 'emailexist';
        } else {
            $isExist = getRecord($table, 'id_number', $fieldCheckData[1]);

            if ($isExist) {
                return 'idnumberexist';
            }
        }
    }

    $lastInsertId = addRecord($data, $fields, $table);
    $getStudentQuery = "SELECT * FROM $table WHERE id = ?";
    $stmt = $conn->prepare($getStudentQuery);
    $stmt->execute(array($lastInsertId));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $userId = addRecord(array($row['id_number']), array('username'), 'users');
    return addRecord(array($userId,3), array('user_id','role_id'), 'role_user');
}


function updateRecord($data,$fields,$table,$field_id){
    $conn = connect();
    $val = array();
    foreach($fields as $fld)
    $val[] = $fld."=?";
    $values = implode(",",$val);
    $sql = "UPDATE $table SET $values WHERE $field_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute($data);
}




?>