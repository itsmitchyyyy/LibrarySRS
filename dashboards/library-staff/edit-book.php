<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<nav class="py-4" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="books.php">Books</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
  </ol>
</nav>
<?php
  if (isset($_GET['id'])) {
    $book = getRecord('books', 'id', $_GET['id']);
    $categories = getRecords('categories');
  }
?>
<!-- end Modal -->

<div class="w-25">
<form method="post">
<div class="form-group">
          <label for="ddcTitle">DDC Title</label>
          <input type="text" value="<?php echo $book['ddc']; ?>" name="ddcTitle" class="form-control" id="ddcTitleInput" aria-describedby="ddcTitleHelp">
        </div>
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" value="<?php echo $book['author']; ?>" name="author" class="form-control" id="authorInput" aria-describedby="authorHelp">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" name="description" id="descriptionId" rows="3"><?php echo $book['description']; ?></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" name="category" id="categoryInput">
            <?php foreach($categories as $category) { ?>
              <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $book['category_id']) ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="editionNumber">Edition Number</label>
          <input type="text" value="<?php echo $book['edition_number']; ?>" name="editionNumber" class="form-control" id="editionNumberInput" aria-describedby="editionNumberHelp">
        </div>
        <div class="form-group">
          <label for="placeOfPublication">Place of publication</label>
          <input type="text" value="<?php echo $book['place_of_publication']; ?>" name="placeOfPublication" class="form-control" id="placeOfPublicationInput" aria-describedby="placeOfPublicationHelp">
        </div>
        <div class="form-group">
          <label for="publisherName">Publisher name</label>
          <input type="text" value="<?php echo $book['publisher']; ?>" name="publisherName" class="form-control" id="publisherNameInput" aria-describedby="publisherNameHelp">
        </div>
        <div class="form-group">
          <label for="copyright">Copyright</label>
          <input type="text" value="<?php echo $book['copyright']; ?>" name="copyright" class="form-control" id="copyrightInput" aria-describedby="copyrightHelp">
        </div>
        <div class="d-flex flex-row flex-fill justify-content-end">
        <button type="button" class="mr-1 btn btn-secondary" onclick="goBack()">Cancel</button>
        <input type="submit" value="Update" name="updateBookBtn" class="ml-1 btn btn-primary" />
    
        </div>
</form>


<?php
  if (isset($_POST['updateBookBtn'])) {
    $book =  updateRecord(array($_POST['ddcTitle'],$_POST['author'],$_POST['description'],$_POST['category'],$_POST['editionNumber'],$_POST['placeOfPublication'],$_POST['publisherName'],$_POST['copyright'], $_GET['id'])
    ,array('ddc','author','description','category_id','edition_number','place_of_publication','publisher','copyright'),'books','id');
    
    if ($book) {
        echo "<script> window.location = 'books.php?m=Updated Book'; </script>";
    }
  }
?>
</div>

</main>
</div>
</div>


<?php include 'inc/footer.php' ?>