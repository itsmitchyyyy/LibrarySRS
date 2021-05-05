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
                  <th>Title</th>
                  <th>Author</th>
                  <th>Status</th>
                  <th>Date Borrowed</th>
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
                if (isset($penalty['due_date']) && (new DateTime() > new DateTime($penalty['due_date']))  && $user['role'] == 'student') {
                  updateRecord(array('49', $penalty['id']),array('amount'),'penalties','id');
                }
              
              ?>
                <tr>
                  <td><?php echo $book['id']?></td>
                  <td><?php echo $book['ddc'] ?></td>
                  <td><?php echo $book['author'] ?></td>
                  <td><?php echo $borrowed['status'] ?></td>
                  <td><?php echo date_format(date_create($borrowed['created_at']), 'F d, Y'); ?></td>
                  <td><?php echo isset($penalty['due_date']) ? date_format(date_create($penalty['due_date']), 'F d, Y') : ''; ?></td>
                  <td><?php echo isset($penalty['amount']) ? $penalty['amount'] : 0 ?></td>
                  <td>
                    <form method="post">
                      <input type="hidden" value="approved" name="borrowedStatus">
                      <input type="hidden" value="<?php echo $borrowed['id'] ?>" name="borrowedId">
                      <input type="hidden" value="<?php echo $borrowed['penalty_id'] ?>" name="penaltyId">
                      <input type="submit" name="approvedBtn" value="Approve" class="btn btn-success btn-sm">
                    </form>
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
  if (isset($_POST['approvedBtn'])) {
    $book =  updateRecord(array($_POST['borrowedStatus'], date('Y-m-d H:i:s'), $_SESSION['role'], $_POST['borrowedId'])
    ,array('status','approved_date','approved_by'),'reservations','id');

 
    if ($book && $_POST['borrowedStatus'] == 'approved') {
      $dueDate = date('Y-m-d', strtotime(date('Y-m-d H:i:s'). ' + 3 days'));
      $amount = 0;
      updateRecord(array($amount, $dueDate, $_POST['penaltyId']),array('amount','due_date'),'penalties','id');
    }
    // $book =  updateRecord(array($_POST['borrowedStatus'], date('Y-m-d H:i:s'), $_POST['borrowedId'])
    // ,array('status','approved_date'),'reservations','id');
    
    if ($book) {
        echo "<script> window.location = 'reservations.php?m=Updated Reservation'; </script>";
    }
  }
?>


<?php include 'inc/footer.php' ?>