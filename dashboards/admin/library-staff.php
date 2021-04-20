<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Library Staff</h2>
  </div>

 

  <div class="d-flex flex-fill justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#addStaffModal" class="btn btn-sm btn-primary">
        <i class="fas fa-user-plus"></i> Add Staff
      </button>
  </div>
</div>


<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25" role="alert">
    <?php echo (isset($_GET['e'])) ? $_GET['e'] : $_GET['m'] ?>
</div>
<?php }

?>

<!-- Modal -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Staff</h5>
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
          <label for="course">Course</label>
          <input type="text" name="course" class="form-control" id="courseInput" aria-describedby="courseHelp">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="addStaffBtn" class="btn btn-primary" value="Add Staff" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->


<?php
  if (isset($_POST['addStaffBtn'])) {
    $staff = addUser(array($_POST['idNumber'],$_POST['emailAddress'],$_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['course']), 
    array('id_number','email','first_name','middle_name','last_name','contact_number','course'), 'library_staffs', array($_POST['emailAddress'], $_POST['idNumber']), 'staff');

    if ($staff == 'emailexist') {
      echo "<script> alert('Email Exist'); </script>";
    } else if ($staff == 'idnumberexist') {
      echo "<script> alert('Id Number Exist'); </script>";
    } else {
      if ($staff) {
        echo "<script> window.location = document.referrer; </script>";
      }
    }
  }

  
  $staffList = getRecordsWithCondition('library_staffs','status','active');
?>
 <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Staff Name</th>
                  <th>Contact Number</th>
                  <th>Course</th>
                  <th>Email</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($staffList as $staff) { ?>
                <tr>
                  <td><?php echo $staff['id_number'] ?></td>
                  <td><?php echo "{$staff['first_name']} {$staff['middle_name']}. {$staff['last_name']}" ?></td>
                  <td><?php echo $staff['contact_number'] ?></td>
                  <td><?php echo $staff['course'] ?></td>
                  <td><?php echo $staff['email'] ?></td>
                  <td>
                    <a href="edit-staff.php?id=<?php echo $staff['id'] ?>" class="btn btn-primary">Update</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteStaffModal" data-id="<?php echo $staff['id'] ?>" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

<!-- delete modal -->
<div class="modal fade" id="deleteStaffModal" tabindex="-1" aria-labelledby="deleteStaffModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Staff</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <p>Are you sure you want to delete this staff?</p>
        <input type="hidden" name="staffId" value="0" id="staffId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="deleteStaffBtn" class="btn btn-danger" value="Delete Staff" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

<?php
  if (isset($_POST['deleteStaffBtn'])) {
    $book =  updateRecord(array('disabled',$_POST['staffId'])
    ,array('status'),'library_staffs','id');
    
    if ($book) {
        echo "<script> window.location = 'library-staff.php?m=Deleted Staff'; </script>";
    }
  }
?>
</main>
</div>
</div>


<script>
  var deleteStaffModal = document.getElementById('deleteStaffModal');
    deleteStaffModal.addEventListener('show.bs.modal', function (event) {
        var staffId = event.relatedTarget.getAttribute('data-id');
        var staffIdInput = deleteStaffModal.querySelector('#staffId');
        staffIdInput.value = staffId;
    });
</script>
<?php include 'inc/footer.php' ?>