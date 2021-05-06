<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<?php include '../../db/connection.php' ?>

<div class="d-flex flex-row py-4">
  <div class="d-flex flex-fill">
    <h2>Books</h2>
  </div>

 
<?php 
  $categoryList = getRecords('categories'); 
?>

  <div class="d-flex flex-fill justify-content-end">
      <button data-bs-toggle="modal" data-bs-target="#addBookModal" class="btn btn-sm btn-primary">
        <i class="fas fa-user-plus"></i> Add Book
      </button>
  </div>
</div>

<div class="flex-row d-flex mb-4">
  <select  class="w-25 form-control"  aria-label="Default select example" id="categorySelect">
      <option disabled selected>Category</option>
    <?php foreach($categoryList as $category) { ?>
      <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
    <?php } ?>
  </select>
  <input type="text"  placeholder="Search Book Title"  class="mx-2 w-25 form-control" id="searchBook">
</div>



<?php
if(isset($_GET['e']) || isset($_GET['m'])) { ?>
  <div class="alert <?php echo (isset($_GET['e'])) ? 'alert-danger' : 'alert-success'?> w-25" role="alert">
    <?php echo (isset($_GET['e'])) ? $_GET['e'] : $_GET['m'] ?>
</div>

<?php }
 $categoryList = getRecords('categories');
?>


<div id="isSearching" style="display:none">
  <p>Searching books...</p>
</div>

<!-- Modal -->
<div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="ddcTitle">DDC Title</label>
          <input type="text" name="ddcTitle" class="form-control" id="ddcTitleInput" aria-describedby="ddcTitleHelp">
        </div>
        <div class="form-group">
          <label for="author">Author</label>
          <input type="text" name="author" class="form-control" id="authorInput" aria-describedby="authorHelp">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" name="description" id="descriptionId" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="category">Category</label>
          <select class="form-control" name="category" id="categoryInput">
            <?php foreach($categoryList as $category) { ?>
              <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="editionNumber">Edition Number</label>
          <input type="text" name="editionNumber" class="form-control" id="editionNumberInput" aria-describedby="editionNumberHelp">
        </div>
        <div class="form-group">
          <label for="placeOfPublication">Place of publication</label>
          <input type="text" name="placeOfPublication" class="form-control" id="placeOfPublicationInput" aria-describedby="placeOfPublicationHelp">
        </div>
        <div class="form-group">
          <label for="publisherName">Publisher name</label>
          <input type="text" name="publisherName" class="form-control" id="publisherNameInput" aria-describedby="publisherNameHelp">
        </div>
        <div class="form-group">
          <label for="copyright">Copyright</label>
          <input type="text" name="copyright" class="form-control" id="copyrightInput" aria-describedby="copyrightHelp">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="addBookBtn" class="btn btn-primary" value="Add Book" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal -->


<?php
  if (isset($_POST['addBookBtn'])) {
    $books = addRecord(array($_POST['ddcTitle'],$_POST['author'],$_POST['description'],$_POST['category'],$_POST['editionNumber'],$_POST['placeOfPublication'],$_POST['publisherName'],$_POST['copyright']), 
    array('ddc','author','description','category_id','edition_number','place_of_publication','publisher','copyright'), 'books');

    if ($books) {
      echo "<script> window.location = document.referrer; </script>";
    }
  }

  
  $bookList = getRecordsWithCondition('books','status','published');
?>


<div class="card-deck" id="initialCardDeck">
  <?php foreach($bookList as $books) { ?>
    <div class="card mr-4"  style="width: 18rem;flex:initial">
      <img class="card-img-top" src="https://via.placeholder.com/286x180" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title"><?php echo $books['ddc']; ?></h5>
        <p class="card-text"><?php echo $books['description']; ?></p>
      </div>
      <div class="card-footer">
        <div class="d-flex flex-row flex-wrap">
          <div class="d-flex">
            <small class="text-muted">Last updated <?php echo time_elapsed_string(strtotime($books['updated_at'])); ?></small>
          </div>
          <div class="d-flex flex-fill align-items-center justify-content-end">
              <a href="edit-book.php?id=<?php echo $books['id'] ?>"  title="Edit" class="mr-1"><i class="fas fa-edit"></i></a>
              <a href="#" style="color:red" data-bs-toggle="modal" data-bs-target="#deleteBookModal" data-id="<?php echo $books['id'] ?>"  title="Delete"><i class="fas fa-trash-alt"></i></a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<div class="card-deck" style="display:none" id="searchCardDeck">
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteBookModal" tabindex="-1" aria-labelledby="deleteBookModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Book</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <p>Are you sure you want to delete this book?</p>
        <input type="hidden" name="bookId" value="0" id="bookId">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="deleteBookBtn" class="btn btn-danger" value="Delete Book" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

<?php
  if (isset($_POST['deleteBookBtn'])) {
    $book =  updateRecord(array('disabled',$_POST['bookId'])
    ,array('status'),'books','id');
    
    if ($book) {
        echo "<script> window.location = 'books.php?m=Deleted Book'; </script>";
    }
  }
?>
</main>
</div>
</div>

<script>
var deleteBookModal = document.getElementById('deleteBookModal');
    deleteBookModal.addEventListener('show.bs.modal', function (event) {
        var bookId = event.relatedTarget.getAttribute('data-id');
        var bookIdInput = deleteBookModal.querySelector('#bookId');
        bookIdInput.value = bookId;
    });

    
    // var url = 'http://localhost/librarysrs-master/db/functions';
    var url = 'http://localhost/librarysrs/db/functions';
    var searchBookInput = document.getElementById('searchBook');
    var categorySearchBookInput = document.getElementById('categorySelect');

    searchBookInput.addEventListener('keyup', () => {
          var bookSearchUrl = url + '/getBooks.php?title=' + event.target.value + '&type=search';
          searchBook(event.target.value, bookSearchUrl)
        }, false);
        categorySearchBookInput.addEventListener('change', () => {
          var bookCategoryyFilterUrl = url + '/getBooks.php?id=' + event.target.value + '&type=filter';
          searchBook(event, bookCategoryyFilterUrl) 
        }, false);


        async function searchBook(title, bookUrl) {
          var isSearching = document.getElementById('isSearching');
          var initialCardDeck = document.getElementById('initialCardDeck');
          var searchCardDeck = document.getElementById('searchCardDeck');

          isSearching.style.display = 'block';
          initialCardDeck.style.display = 'none';
          searchCardDeck.style.display = 'none';

          let response = await fetch(bookUrl);
          response  = await response.json();

          var searchCardDeckData = '';

          setTimeout(function () {
            let options = {  month: 'long', day: 'numeric', year: 'numeric' };
            if (response.length) {
              response.map((item) => {
                searchCardDeckData += `<div class="card mr-4" style="width: 18rem;flex:initial">
                          <div class="card-header">
                              <small class="text-muted">Published on ` +  new Date(item.updated_at).toLocaleDateString('en-US', options) + `</small>
                          </div>
                          <img class="card-img-top" src="https://via.placeholder.com/286x180" alt="Card image cap">
                          <div class="card-body">
                              <h5 class="card-title">` + item.ddc + `</h5>
                              <p class="card-text">` + item.description + `</p>

                          </div>
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item">Author: ` + item.author + `</li>
                              <li class="list-group-item">Publisher: ` + item.publisher + `</li>
                          </ul>
                          <div class="card-footer">
                              <div class="d-flex flex-row flex-wrap">
                                  <div class="d-flex flex-fill align-items-center justify-content-end">
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#viewBookModal" data-id="` + item.id + `" class="btn btn-secondary  btn-sm me-1">View Info</a>
                                      <a href="#" data-bs-toggle="modal" data-bs-target="#borrowBookModal" data-id="` + item.id + `" class="btn btn-primary btn-sm ml-1">Borrow</i></a>
                                  </div>
                              </div>
                          </div>
                      </div>`;
              });
          } else {
            searchCardDeckData += `No search results found`;
          }

            isSearching.style.display = 'none';
            searchCardDeck.innerHTML = searchCardDeckData;
            searchCardDeck.style.display = 'flex';
          }, 1000);
        } 
</script>
<?php include 'inc/footer.php' ?>