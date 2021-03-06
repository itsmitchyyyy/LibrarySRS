<?php include 'inc/header.php' ?>
<?php include '../../db/connection.php' ?>

<?php
$borrowedList = getRecordsWithCondition('reservations','user_id', $_SESSION['user']['userId']);
?>

<div class="container h-100 p-4">

<h4>Transaction List</h4>

<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25 my-4 ms-auto me-auto w-50" role="alert">
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
                  <th>Approved Date</th>
                  <th>Returned Date</th>
                  <th>Due Date</th>
                  <th>Penalty</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($borrowedList as $borrowed) { ?>
              <?php $book = getRecord('books', 'id', $borrowed['book_id']); ?>
              <?php $penalty = getRecord('penalties','id', $borrowed['penalty_id']); ?>
              <?php 
                if (isset($penalty['due_date']) && (new DateTime() > new DateTime($penalty['due_date']))) {
                  updateRecord(array('49', $penalty['id']),array('amount'),'penalties','id');
                }
                
                $date1 = new DateTime($borrowed['created_at']);
                $date2 = new DateTime();
                $diff = $date2->diff($date1);

                if ($borrowed['status'] == 'pending' &&  $diff->h > 5 && $user['role'] == 'student') {
                  updateRecord(array('expired', $borrowed['id']),array('status'),'reservations','id');
                }
              
              ?>
                <tr>
                  <td><?php echo $book['id']?></td>
                  <td><?php echo $book['ddc'] ?></td>
                  <td><?php echo $book['author'] ?></td>
                  <td style="color: <?php echo ($borrowed['status'] == 'returned') ? 'blue'  : (($borrowed['status'] == 'pending') ? 'red' : 'green') ?>"><?php echo $borrowed['status'] ?></td>
                  <td><?php echo $borrowed['approved_date'] ? date_format(date_create($borrowed['approved_date']), 'F d, Y') : '' ?></td>
                  <td><?php echo $borrowed['return_date'] ? date_format(date_create($borrowed['return_date']), 'F d, Y') : '' ?></td>
                  <td><?php echo isset($penalty['due_date']) ? date_format(date_create($penalty['due_date']), 'F d, Y') : ''; ?></td>
                  <td><?php echo isset($penalty['amount']) ? $penalty['amount'] : 0 ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          </div>

<?php include 'inc/footer.php' ?>