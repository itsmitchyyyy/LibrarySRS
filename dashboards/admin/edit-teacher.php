<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<nav class="py-4" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="teachers.php">Teacher</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<?php
  if (isset($_GET['id'])) {
    $teacher = getRecord('teachers', 'id', $_GET['id']);
  }
?>
<!-- end Modal -->

<div class="w-25">
<form>
<div class="form-group">
          <label for="idNumber">ID Number</label>
          <input type="text" value="<?php echo $teacher['id_number']; ?>" name="idNumber" class="form-control" id="idNumberInput" aria-describedby="idNumberHelp">
        </div>
        <div class="form-group">
          <label for="emailAddress">Email Address</label>
          <input type="email" value="<?php echo $teacher['email']; ?>" name="emailAddress" class="form-control" id="emailAddressInput" aria-describedby="emailAddressHelp">
        </div>
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" value="<?php echo $teacher['first_name']; ?>" name="firstName" class="form-control" id="firstNameInput" aria-describedby="firstNameHelp">
        </div>
        <div class="form-group">
          <label for="middleName">Middle Name</label>
          <input type="text" value="<?php echo $teacher['middle_name']; ?>" name="middleName" class="form-control" id="middleNameInput" aria-describedby="middleNameHelp">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" value="<?php echo $teacher['last_name']; ?>" name="lastName" class="form-control" id="lastNameInput" aria-describedby="lastNameHelp">
        </div>
        <div class="form-group">
          <label for="contactNumber">Contact Number</label>
          <input type="text" value="<?php echo $teacher['contact_number']; ?>" name="contactNumber" class="form-control" id="contactNumberInput" aria-describedby="contactNumberHelp">
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <input type="text" value="<?php echo $teacher['department']; ?>" name="department" class="form-control" id="departmentInput" aria-describedby="departmentHelp">
        </div>
        <div class="d-flex flex-row flex-fill justify-content-end">
        <button type="submit" class="mr-1 btn btn-secondary">Cancel</button>
        <button type="submit" class="ml-1 btn btn-primary">Update</button>
    
        </div>
</form>
</div>

</main>
</div>
</div>


<?php include 'inc/footer.php' ?>