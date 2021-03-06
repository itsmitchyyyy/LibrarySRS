<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<?php
$borrowedList = getRecords('reservations');
?>
<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Reservations</h2>
  </div>
</div>


<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25" role="alert">
    <?php echo (isset($_GET['e'])) ? $_GET['e'] : $_GET['m'] ?>
</div>
<?php }

?>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>DDC</th>
                  <th>Borrower</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Date Borrowed</th>
                  <th>Returned Date</th>
                  <th>Due Date</th>
                  <th>Penalty</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($borrowedList as $borrowed) { ?>
              <?php $user = getRecord('users', 'id', $borrowed['user_id']) ?>
              <?php $borrower = getRecord($user['role'], 'id', $user['role_id']); ?>
              <?php $book = getRecord('books', 'id', $borrowed['book_id']); ?>
              <?php $penalty = getRecord('penalties','id', $borrowed['penalty_id']); ?>
              <?php 
                if (isset($penalty['due_date']) && (new DateTime() > new DateTime($penalty['due_date'])) && $user['role'] == 'student') {
                  updateRecord(array('49', $penalty['id']),array('amount'),'penalties','id');
                }
              
                
                $date1 = new DateTime($borrowed['updated_at']);
                $date2 = new DateTime();
                $diff = $date2->diff($date1);

                if ($borrowed['status'] == 'pending' &&  $diff->h > 5 && $user['role'] == 'student') {
                  updateRecord(array('expired', $borrowed['id']),array('status'),'reservations','id');
                }
              ?>
                <tr>
                  <td><?php echo $book['id']?></td>
                  <td><?php echo $borrower['first_name'].' '.$borrower['last_name']?></td>
                  <td><?php echo $book['ddc'] ?></td>
                  <td><?php echo $book['author'] ?></td>
                  <td><?php echo $borrowed['status'] ?></td>
                  <td><?php echo date_format(date_create($borrowed['created_at']), 'F d, Y'); ?></td>
                  <td><?php echo $borrowed['return_date'] ? date_format(date_create($borrowed['return_date']), 'F d, Y') : '' ?></td>
                  <td><?php echo isset($penalty['due_date']) ? date_format(date_create($penalty['due_date']), 'F d, Y') : ''; ?></td>
                  <td><?php echo isset($penalty['amount']) ? $penalty['amount'] : 0 ?></td>
                  <td>
                  <?php if($borrowed['status'] == 'pending') { ?>
                    <form method="post">
                      <input type="hidden" value="approved" name="borrowedStatus">
                      <input type="hidden" value="<?php echo $borrowed['id'] ?>" name="borrowedId">
                      <input type="hidden" value="<?php echo $borrowed['penalty_id'] ?>" name="penaltyId">
                      <input type="submit" name="approvedBtn" value="Approve" class="btn btn-success btn-sm">
                    </form>
                  <?php } else if ($borrowed['status'] == 'approved') { ?>
                    <form method="post">
                      <input type="hidden" value="returned" name="borrowedStatus">
                      <input type="hidden" value="<?php echo $borrowed['id'] ?>" name="borrowedId">
                      <input type="hidden" value="<?php echo $borrowed['penalty_id'] ?>" name="penaltyId">
                      <input type="submit" name="returnedBtn" value="Return" class="btn btn-danger btn-sm">
                    </form>
                  <?php }?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
</main>
</div>
</div>


<?php
if (isset($_POST['returnedBtn'])) {
  $book =  updateRecord(array($_POST['borrowedStatus'], date('Y-m-d H:i:s'), $_POST['borrowedId'])
  ,array('status','return_date'),'reservations','id');
  
  if ($book) {
      echo "<script> window.location = 'reservations.php?m=Updated Reservation'; </script>";
  }
}

  if (isset($_POST['approvedBtn'])) {
    $book =  updateRecord(array($_POST['borrowedStatus'], date('Y-m-d H:i:s'), $_SESSION['user']['staffId'], $_SESSION['user']['first_name'], $_POST['borrowedId'])
    ,array('status','approved_date','approver_id','approved_by'),'reservations','id');
    
    if ($book) {
        echo "<script> window.location = 'reservations.php?m=Updated Reservation'; </script>";
    }
  }
?>


<?php include 'inc/footer.php' ?>