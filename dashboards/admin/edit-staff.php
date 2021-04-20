<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<nav class="py-4" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="students.php">Library Staff</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<?php
  if (isset($_GET['id'])) {
    $staff = getRecord('library_staffs', 'id', $_GET['id']);
  }
?>
<!-- end Modal -->

<div class="w-25">
<form method="post">
<div class="form-group">
          <label for="idNumber">ID Number</label>
          <input type="text" value="<?php echo $staff['id_number']; ?>" name="idNumber" class="form-control" id="idNumberInput" aria-describedby="idNumberHelp">
        </div>
        <div class="form-group">
          <label for="emailAddress">Email Address</label>
          <input type="email" value="<?php echo $staff['email']; ?>" name="emailAddress" class="form-control" id="emailAddressInput" aria-describedby="emailAddressHelp">
        </div>
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" value="<?php echo $staff['first_name']; ?>" name="firstName" class="form-control" id="firstNameInput" aria-describedby="firstNameHelp">
        </div>
        <div class="form-group">
          <label for="middleName">Middle Name</label>
          <input type="text" value="<?php echo $staff['middle_name']; ?>" name="middleName" class="form-control" id="middleNameInput" aria-describedby="middleNameHelp">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" value="<?php echo $staff['last_name']; ?>" name="lastName" class="form-control" id="lastNameInput" aria-describedby="lastNameHelp">
        </div>
        <div class="form-group">
          <label for="contactNumber">Contact Number</label>
          <input type="text" value="<?php echo $staff['contact_number']; ?>" name="contactNumber" class="form-control" id="contactNumberInput" aria-describedby="contactNumberHelp">
        </div>
        <div class="form-group">
          <label for="course">Course</label>
          <input type="text" value="<?php echo $staff['course']; ?>" name="course" class="form-control" id="courseInput" aria-describedby="courseHelp">
        </div>
        <div class="d-flex flex-row flex-fill justify-content-end">
        <button type="submit" class="mr-1 btn btn-secondary">Cancel</button>
        <input type="submit" value="Update" name="updateStaffBtn" class="ml-1 btn btn-primary" />
    
        </div>
</form>


<?php
  if (isset($_POST['updateStaffBtn'])) {
    $staff = updateRecord(array($_POST['idNumber'],$_POST['emailAddress'],$_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['course'], $_GET['id'])
    ,array('id_number','email','first_name','middle_name','last_name','contact_number','course'),'library_staffs','id');

      if ($staff) {
        echo "<script> window.location = 'library-staff.php?m=Updated Staff'; </script>";
    }
  }
?>
</div>

</main>
</div>
</div>


<?php include 'inc/footer.php' ?>