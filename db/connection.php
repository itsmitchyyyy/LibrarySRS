<?php
function time_elapsed_string($time) {
    $time_difference = time() - $time;

    if( $time_difference < 1 ) { return 'less than 1 second ago'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}


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
            $_SESSION['role'] = 'admin';
            echo "<script> window.location='dashboards/admin/index.php'; </script>";
            exit;
        } else {
            echo "<script> window.location = document.referrer + '?e=Invalid Username and Password; </script>";
        }
    }else{
        echo "<script> window.location = document.referrer + '?e=Invalid Username and Password; </script>";
    }
}

function loginStudent($username, $password) {
    $conn = connect();
    $sql = "SELECT *, students.id as studentId, users.id as userId, users.created_at as userCreatedAt, users.updated_at as userUpdatedAt,
     students.created_at as studentcreatedAt, students.updated_at as studentUpdatedAt FROM users JOIN students ON students.id = users.role_id WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() > 0){
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            $_SESSION['role'] = 'student';
            echo "<script> window.location='dashboards/students/index.php'; </script>"; 
            exit;
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

function getRecordsWithCondition($table, $field, $condition){
    $conn = connect();
    $sql = "SELECT * FROM $table WHERE $field = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($condition));
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

function addUser($data, $fields, $table, $fieldCheckData = null, $role = 'students') {
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

    $password = password_hash($row['id_number'], PASSWORD_DEFAULT);
    return addRecord(array($row['id_number'], $password, $role, $lastInsertId), array('username','password','role','role_id'), 'users');
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