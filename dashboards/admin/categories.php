<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Categories</h2>
  </div>

 

  <div class="d-flex flex-fill justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#addCategoryModal" class="btn btn-sm btn-primary">
        <i class="fas fa-user-plus"></i> Add Category
      </button>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="ddcNumber">DDC Number</label>
          <input type="text" name="ddcNumber" class="form-control" id="ddcNumberInput" aria-describedby="ddcNumberHelp">
        </div>
        <div class="form-group">
          <label for="categoryName">Category Name</label>
          <input type="text" name="categoryName" class="form-control" id="categoryNameInput" aria-describedby="categoryNameHelp">
        </div>
        <div class="form-group">
          <label for="categoryAlias">Category Alias</label>
          <input type="text" name="categoryAlias" class="form-control" id="categoryAliasInput" aria-describedby="categoryAliasHelp">
        </div>
        <div class="form-group">
          <label for="categoryDescription">Category Description</label>
          <textarea class="form-control" name="categoryDescription" id="categoryDescriptionId" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="addCategoryBtn" class="btn btn-primary" value="Add Category" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->

<?php
  if (isset($_POST['addCategoryBtn'])) {
    $category = addRecord(array($_POST['ddcNumber'],$_POST['categoryName'],$_POST['categoryAlias'],$_POST['categoryDescription']), 
    array('ddc','alias','name','description'), 'categories');

    if ($category) {
      echo "<script> window.location = document.referrer; </script>";
    }
  }

  
  $categoryList = getRecords('categories');
?>

<div class="list-group">
  <?php foreach($categoryList as $categories) { ?> 
    <li class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1"><?php echo $categories['name'] ?></h5>
          <small><?php echo date_format(date_create($categories['created_at']), 'F d, Y g:i A') ?></small>
      </div>
      <p class="mb-1"><?php echo $categories['description'] ?></p>
      <small><?php echo $categories['ddc'] ?></small>
    </li>
  <?php } ?>
</div>
</main>
</div>
</div>


<?php include 'inc/footer.php' ?>