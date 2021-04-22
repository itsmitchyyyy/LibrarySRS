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
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($borrowedList as $borrowed) { ?>
              <?php $book = getRecord('books', 'id', $borrowed['book_id']); ?>
                <tr>
                  <td><?php echo $book['id']?></td>
                  <td><?php echo $book['ddc'] ?></td>
                  <td><?php echo $book['author'] ?></td>
                  <td><?php echo $borrowed['status'] ?></td>
                  <td><?php echo $borrowed['approved_date'] ? date_format(date_create($borrowed['approved_date']), 'F d, Y') : '' ?></td>
                  <td><?php echo $borrowed['return_date'] ? date_format(date_create($borrowed['return_date']), 'F d, Y') : '' ?></td>
                  <td>
                    <form method="post">
                      <input type="hidden" value="returned" name="borrowedStatus">
                      <input type="hidden" value="<?php echo $borrowed['id'] ?>" name="borrowedId">
                      <input type="submit" <?php echo ($borrowed['status'] == 'returned' || $borrowed['status'] == 'pending') ? 'disabled': '' ?>  name="approvedBtn" value="Return" class="btn btn-primary btn-sm">
                    </form>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
          </div>


          <?php
  if (isset($_POST['approvedBtn'])) {
    $book =  updateRecord(array($_POST['borrowedStatus'], date('Y-m-d H:i:s'), $_POST['borrowedId'])
    ,array('status','return_date'),'reservations','id');
    
    if ($book) {
        echo "<script> window.location = 'transactions.php?m=Updated Transactions'; </script>";
    }
  }
?>

<?php include 'inc/footer.php' ?>