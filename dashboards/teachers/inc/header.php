
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <style>

        html,body{
            height: 100%;
        }
        .loginRightContainer {
            background-image: url('assets/img/92057062_2629866447337655_6012574599420575744_n.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .loginRightFormContainer {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .carousel .carousel-item {
            height: 600px;
        }

        .carousel-item img {
            position: absolute;
            object-fit:cover;
            top: 0;
            left: 0;
            min-height: 600px;
        }

        .footerContainer {
            height: 100px;
            background: #295ba5;
            color: #fff;
        }

        .card-deck {
          display: flex;
          flex-direction: row;
          flex-wrap: wrap;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #295ba5">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        CEBU EASTERN COLLEGE LIBRARY
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Books</a>
        </li>
    
      </ul>
      <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?php echo $_SESSION['user']['first_name'] ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><a class="dropdown-item" href="transactions.php">Transactions</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signOutModal">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- signout modal -->
<div class="modal fade" id="signOutModal" tabindex="-1" aria-labelledby="signOutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Signout</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
      <div class="modal-body">
        <p>Are you sure you want to signout?</p>
        <input type="hidden" name="isSignout" value="1" id="isSignout">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <input type="submit" name="signOutBtn" class="btn btn-danger" value="Signout" />
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end modal -->

<?php
  if (isset($_POST['signOutBtn'])) {
    session_unset();
    session_destroy();

    echo "<script> window.location = '../../index.php'; </script>";
  }
?>



    