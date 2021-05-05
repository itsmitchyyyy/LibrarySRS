<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Teachers</h2>
  </div>
  <div class="d-flex flex-fill justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary">
        <i class="fas fa-user-plus"></i> Add Teachers
      </button>
  </div>
</div>

<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25" role="alert">
    <?php echo (isset($_GET['e'])) ? $_GET['e'] : $_GET['m'] ?>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Teachers</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="idNumber">ID Number</label>
          <input type="text" name="idNumber" class="form-control" id="idNumberInput" aria-describedby="idNumberHelp">
        </div>
        <div class="form-group">
          <label for="emailAddress">Email Address</label>
          <input type="email" name="emailAddress" class="form-control" id="emailAddressInput" aria-describedby="emailAddressHelp">
        </div>
        <div class="form-group">
          <label for="firstName">First Name</label>
          <input type="text" name="firstName" class="form-control" id="firstNameInput" aria-describedby="firstNameHelp">
        </div>
        <div class="form-group">
          <label for="middleName">Middle Name</label>
          <input type="text" name="middleName" class="form-control" id="middleNameInput" aria-describedby="middleNameHelp">
        </div>
        <div class="form-group">
          <label for="lastName">Last Name</label>
          <input type="text" name="lastName" class="form-control" id="lastNameInput" aria-describedby="lastNameHelp">
        </div>
        <div class="form-group">
          <label for="contactNumber">Contact Number</label>
          <input type="text" name="contactNumber" class="form-control" id="contactNumberInput" aria-describedby="contactNumberHelp">
        </div>
        <div class="form-group">
          <label for="department">Department</label>
          <input type="text" name="department" class="form-control" id="departmentInput" aria-describedby="departmentHelp">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="addTeacherBtn" class="btn btn-primary" value="Add Teacher" />
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  if (isset($_POST['addTeacherBtn'])) {
    $teacher = addUser(array($_POST['idNumber'],$_POST['emailAddress'],$_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['department']), 
    array('id_number','email','first_name','middle_name','last_name','contact_number','department'), 'teachers', array($_POST['emailAddress'], $_POST['idNumber']), 'teachers');

    if ($teacher == 'emailexist') {
      echo "<script> alert('Email Exist'); </script>";
    } else if ($teacher == 'idnumberexist') {
      echo "<script> alert('Id Number Exist'); </script>";
    } else {
      if ($teacher) {
        echo "<script> window.location = document.referrer; </script>";
      }
    }
  }


  $teacherList = getRecordsWithCondition('teachers','status','active');
?>
<!-- end Modal -->

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Teacher Name</th>
                  <th>Contact Number</th>
                  <th>Department</th>
                  <th>Email</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($teacherList as $teacher) { ?>
                <tr>
                  <td><?php echo $teacher['id_number'] ?></td>
                  <td><?php echo "{$teacher['first_name']} {$teacher['middle_name']}. {$teacher['last_name']}" ?></td>
                  <td><?php echo $teacher['contact_number'] ?></td>
                  <td><?php echo $teacher['department'] ?></td>
                  <td><?php echo $teacher['email'] ?></td>
                  <td>
                    <a href="edit-teacher.php?id=<?php echo $teacher['id'] ?>" class="btn btn-primary">Update</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>


<?php
  if (isset($_POST['deleteTeacherBtn'])) {
    $student =  updateRecord(array('disabled',$_POST['teacherId']),array('status'),'teachers','id');
   
    if ($student) {
        echo "<script> window.location = 'teachers.php?m=Deleted Teacher'; </script>";
    }
  }
?>
</main>
</div>
</div>


<?php include 'inc/footer.php' ?>