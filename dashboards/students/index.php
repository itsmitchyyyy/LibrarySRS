<?php include 'inc/header.php' ?>
<?php include '../../db/connection.php' ?>

<?php 
  $bookList = getRecordsWithCondition('books','status','published');
  $categoryList = getRecords('categories');
?>

<div class="container my-4">

<div class="flex-row d-flex">
  <select  class="w-25 form-select"  aria-label="Default select example" id="categorySelect">
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

?>

<div id="isSearching" style="display:none">
  <p>Searching books...</p>
</div>

<div class="card-deck mt-5" id="initialCardDeck">
  <?php foreach($bookList as $books) { ?>
        <div class="card me-4" style="width: 18rem">
            <div class="card-header">
                <small class="text-muted">Published on <?php echo date_format(date_create($books['updated_at']), 'F d, Y'); ?></small>
            </div>
            <img class="card-img-top" src="https://via.placeholder.com/286x180" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $books['ddc']; ?></h5>
                <p class="card-text"><?php echo $books['description']; ?></p>

            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Author: <?php echo $books['author'] ?></li>
                <li class="list-group-item">Publisher: <?php echo $books['publisher'] ?></li>
            </ul>
            <div class="card-footer">
                <div class="d-flex flex-row flex-wrap">
                    <div class="d-flex flex-fill align-items-center justify-content-end">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewBookModal" data-id="<?php echo $books['id'] ?>" class="btn btn-secondary  btn-sm me-1">View Info</a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#borrowBookModal" data-id="<?php echo $books['id'] ?>" class="btn btn-primary btn-sm ml-1">Borrow</i></a>
                    </div>
                </div>
            </div>
        </div>
  <?php } ?>
    </div>

    


<div class="card-deck mt-5" style="display:none" id="searchCardDeck">
</div>
</div>


<!-- delete modal -->
<div class="modal fade" id="borrowBookModal" tabindex="-1" aria-labelledby="borrowBookModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Borrow Book</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <p>Do you want to borrow this book?</p>
        <input type="hidden" name="bookId" value="0" id="bookId">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'student') { ?>
            <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['userId'] ?>" id="userId">
        <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="borrowBookBtn" class="btn btn-primary" value="Proceed" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

<?php
  if (isset($_POST['borrowBookBtn'])) {
    $books = addRecord(array($_POST['userId'],$_POST['bookId'],'pending'), 
    array('user_id','book_id','status'), 'reservations');

    if ($books) {
      echo "<script> window.location = 'index.php?m=Success Borrow Book'; </script>";
    }
  }
?>

<!-- view modal -->
<div class="modal fade" id="viewBookModal" tabindex="-1" aria-labelledby="viewBookModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Book Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <div class="d-flex flex-column">
            <div class="d-flex flex-column mb-1">
                <span><strong>Book Title</strong></span>
                <span id="bookTitle"></span>
            </div>
            <div class="d-flex flex-column mb-1">
                <span><strong>Book Description</strong></span>
                <span id="bookDescription"></span>
            </div>
            <div class="d-flex flex-column mb-1">
                <span><strong>Book Author</strong></span>
                <span id="bookAuthor"></span>
            </div>
            <div class="d-flex flex-column mb-1">
                <span><strong>Publisher</strong></span>
                <span id="bookPublisher"></span>
            </div>
            <div class="d-flex flex-column mb-1">
                <span><strong>Published on</strong></span>
                <span id="bookPublished"></span>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
<!-- end view modal -->


<script>
    var url = 'http://localhost/librarysrs/db/functions';
    var viewBookModal = document.getElementById('viewBookModal');
    var borrowBookModal = document.getElementById('borrowBookModal');
    var searchBookInput = document.getElementById('searchBook');
    var categorySearchBookInput = document.getElementById('categorySelect');

        viewBookModal.addEventListener('show.bs.modal', function (event) {
            var bookId = event.relatedTarget.getAttribute('data-id');

            let request = new XMLHttpRequest();
            var bookUrl = url + '/getBooks.php?id=' + bookId + '&type=first';
            request.open("GET", bookUrl);
            request.send();
            request.onload = () => {
                const data = JSON.parse(request.response);
                viewBookModal.querySelector('#bookTitle').innerHTML = data.ddc;
                viewBookModal.querySelector('#bookDescription').innerHTML = data.description;
                viewBookModal.querySelector('#bookAuthor').innerHTML = data.author;
                viewBookModal.querySelector('#bookPublisher').innerHTML = data.publisher;
                viewBookModal.querySelector('#bookPublished').innerHTML = new Date(data.created_at).toLocaleString('default', { month: 'long', day: 'numeric', year: 'numeric' });
            }
        });

        borrowBookModal.addEventListener('show.bs.modal', function (event) {
            var bookId = event.relatedTarget.getAttribute('data-id');
            
            borrowBookModal.querySelector('#bookId').value = bookId;
        });

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
                searchCardDeckData += `<div class="card me-4" style="width: 18rem">
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