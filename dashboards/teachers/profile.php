<?php include 'inc/header.php' ?>
<?php include '../../db/connection.php' ?>

<div class="container">

<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25 my-4 ms-auto me-auto w-50" role="alert">
    <?php echo (isset($_GET['e'])) ? $_GET['e'] : $_GET['m'] ?>
</div>
<?php }

?>
    <div class="card my-4 ms-auto me-auto w-50">
        <div class="card-header">
            <h4>Profile Settings</h4>
        </div>
        <form method="post">
            <div class="card-body">
                <div class="form-group">
                    <label for="userID">User ID</label>
                    <input type="text" disabled value="<?php echo $_SESSION['user']['username']; ?>" name="userID" class="form-control" id="userIDInput" aria-describedby="userIDHelp">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" disabled value="<?php echo $_SESSION['user']['email']; ?>" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
                </div>
                <div class="form-group my-1">
                    <label for="firstName">First Name</label>
                    <input type="text"  value="<?php echo $_SESSION['user']['first_name']; ?>" name="firstName" class="form-control" id="firstNameInput" aria-describedby="firstNameHelp">
                </div>
                <div class="form-group my-1">
                    <label for="middleName">Middle Name</label>
                    <input type="text"  value="<?php echo $_SESSION['user']['middle_name']; ?>" name="middleName" class="form-control" id="middleNameInput" aria-describedby="middleNameHelp">
                </div>
                <div class="form-group my-1">
                    <label for="lastName">Last Name</label>
                    <input type="text"  value="<?php echo $_SESSION['user']['last_name']; ?>" name="lastName" class="form-control" id="lastNameInput" aria-describedby="lastNameHelp">
                </div>
                <div class="form-group my-1">
                    <label for="contactNumber">Contact Number</label>
                    <input type="text"  value="<?php echo $_SESSION['user']['contact_number']; ?>" name="contactNumber" class="form-control" id="contactNumberInput" aria-describedby="contactNumberHelp">
                </div>
                <div class="form-group my-1">
                    <label for="department">Department</label>
                    <input type="text"  value="<?php echo $_SESSION['user']['department']; ?>" name="department" class="form-control" id="departmentInput" aria-describedby="departmentHelp">
                </div>
                <hr />
                <div class="form-group my-1">
                    <label for="course">Old Password</label>
                    <input type="password"   name="password" class="form-control" id="courseInput" aria-describedby="courseHelp">
                </div>
                <div class="form-group my-1">
                    <label for="course">New Password</label>
                    <input type="password"  name="newPassword" class="form-control" id="courseInput" aria-describedby="courseHelp">
                </div>
                <div class="form-group my-1">
                    <label for="course">Repeat New Password</label>
                    <input type="password"  name="repeatNewPassword" class="form-control" id="courseInput" aria-describedby="courseHelp">
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-fill align-items-center justify-content-end">
                   <input type="submit" class="btn btn-primary btn-sm" name="updateProfile" value="Update" />
                </div>
            </div>
        </form>
    </div>
</div>


<?php
  if (isset($_POST['updateProfile'])) {
    if ($_POST['password'] != '') {
        $password = password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
        if ($_POST['newPassword'] != $_POST['repeatNewPassword']) {
            echo "<script> window.location = 'profile.php?e=Password does not match'; </script>";
            exit;
        } else {
            updateRecord(array($_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['department'], $_SESSION['user']['teacherId'])
            ,array('first_name','middle_name','last_name','contact_number','department'),'teachers','id');

            $profile = updateRecord(array($password, $_SESSION['user']['userId'])
                ,array('password'),'users','id');
        }
    } else {
        $profile = updateRecord(array($_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['department'], $_SESSION['user']['teacherId'])
        ,array('first_name','middle_name','last_name','contact_number','department'),'teachers','id');
    }
    
    $_SESSION['user'] = getTeacher($_SESSION['user']['userId']);
    if ($profile) {
        echo "<script> window.location = 'profile.php?m=Updated Profile'; </script>";
        exit;
    }
  }
?>

<?php include 'inc/footer.php' ?>