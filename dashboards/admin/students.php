<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Students</h2>
  </div>

 

  <div class="d-flex flex-fill justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-sm btn-primary">
        <i class="fas fa-user-plus"></i> Add Student
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


<div class="flex-row d-flex mb-2">
  <input type="text"  placeholder="Student Name"  class=" w-25 form-control" id="searchStudent">
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
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
        <input type="submit" name="addStudentBtn" class="btn btn-primary" value="Add Student" />
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  if (isset($_POST['addStudentBtn'])) {
    $student = addUser(array($_POST['idNumber'],$_POST['emailAddress'],$_POST['firstName'],$_POST['middleName'],$_POST['lastName'],$_POST['contactNumber'],$_POST['course']), 
    array('id_number','email','first_name','middle_name','last_name','contact_number','course'), 'students', array($_POST['emailAddress'], $_POST['idNumber']));

    if ($student == 'emailexist') {
      echo "<script> alert('Email Exist'); </script>";
    } else if ($student == 'idnumberexist') {
      echo "<script> alert('Id Number Exist'); </script>";
    } else {
      if ($student) {
        echo "<script> window.location = document.referrer; </script>";
      }
    }
  }


  $studentList = getRecordsWithCondition('students','status','active');
?>
<!-- end Modal -->


<div id="isSearching" style="display:none">
  <p>Searching students...</p>
</div>

          <div class="table-responsive">
            <table class="table table-striped table-sm" id="tableContainer">
              <thead>
                <tr>
                  <th>ID Number</th>
                  <th>Student Name</th>
                  <th>Contact Number</th>
                  <th>Course</th>
                  <th>Email</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody id="tableBody">
              <?php foreach($studentList as $student) { ?>
                <tr>
                  <td><?php echo $student['id_number'] ?></td>
                  <td><?php echo "{$student['first_name']} {$student['middle_name']}. {$student['last_name']}" ?></td>
                  <td><?php echo $student['contact_number'] ?></td>
                  <td><?php echo $student['course'] ?></td>
                  <td><?php echo $student['email'] ?></td>
                  <td>
                    <a href="edit-student.php?id=<?php echo $student['id'] ?>" class="btn btn-primary">Update</a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteStudentModal" data-id="<?php echo $student['id'] ?>" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>

        
<!-- delete modal -->
<div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <p>Are you sure you want to delete this student?</p>
        <input type="hidden" name="studentId" value="0" id="studentId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="deleteStudentBtn" class="btn btn-danger" value="Delete Student" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->


<?php
  if (isset($_POST['deleteStudentBtn'])) {
    $student =  updateRecord(array('disabled',$_POST['studentId']),array('status'),'students','id');
   
    if ($student) {
        echo "<script> window.location = 'students.php?m=Deleted Students'; </script>";
    }
  }
?>
</main>
</div>
</div>


<script>

var deleteStudentModal = document.getElementById('deleteStudentModal');
    deleteStudentModal.addEventListener('show.bs.modal', function (event) {
        var studentId = event.relatedTarget.getAttribute('data-id');
        var studentIdInput = deleteTeacherModal.querySelector('#studentId');
        studentIdInput.value = studentId;
    });


 // var url = 'http://localhost/librarysrs-master/db/functions';
 var url = 'http://localhost/librarysrs/db/functions';
    var searchStudentInput = document.getElementById('searchStudent');
    
    searchStudentInput.addEventListener('keyup', () => {
          var studentSearchUrl = url + '/getTeacherOrStudent.php?role=students&title=' + event.target.value + '&type=search';
          searchBook(event.target.value, studentSearchUrl)
        }, false);

async function searchBook(title, studentUrl) {
          var isSearching = document.getElementById('isSearching');
          var tableContainer = document.getElementById('tableContainer');
          var tableBody = document.getElementById('tableBody');

          isSearching.style.display = 'block';
          tableContainer.style.display = 'none';
          tableBody.innerHTML = '';

          let response = await fetch(studentUrl);
          response  = await response.json();

          var searchTableData = '';

          setTimeout(function () {
            let options = {  month: 'long', day: 'numeric', year: 'numeric' };
            if (response.length) {
              response.map((item) => {
                searchTableData += `<tr>
                  <td>` + item.id_number + `</td>
                  <td>` + item.first_name + item.middle_name + item.last_name + `</td>
                  <td>` + item.contact_number + `</td>
                  <td>` + item.course + `</td>
                  <td>` + item.email + `</td>
                  <td>
                    <a href="edit-student.php?id=`+ item.id + `" class="btn btn-primary">Update</a>
                  </td>
                </tr>`;
              });
          } else {
            searchTableData += `No search results found`;
          }

            isSearching.style.display = 'none';
            tableBody.innerHTML = searchTableData;
            tableContainer.style.display = 'table';
          }, 1000);
        } 
</script>
<?php include 'inc/footer.php' ?>