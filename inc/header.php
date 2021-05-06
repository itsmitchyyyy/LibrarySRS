
<?php session_start() ?>
<?php require 'db/connection.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="assets/js/bootstrap.min.js"></script>
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

<?php $activePage = basename($_SERVER['PHP_SELF'], ".php") ?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #295ba5">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        CEBU EASTERN COLLEGE LIBRARY
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= (strpos($activePage, 'index') !== false) ? 'active' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (strpos($activePage, 'books') !== false) ? 'active' : '' ?>"  href="books.php">Books</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- LOGIN MODAL -->

<div class="modal" id="loginModal">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="position-absolute" style="right:10px;top:10px;z-index:999">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="container-fluid h-100">
                    <div class="row h-100">
                        <div class="col p-0">
                            <div class="loginRightContainer h-100" ></div>
                        </div>
                        <div class="col p-0">
                            <div class="loginRightFormContainer align-items-center">
                                <form class="w-50" method="post">
                                    <div class="d-flex justify-content-center mb-5"><h4>Member Login</h4></div>
                                    <?php
                                        if(isset($_GET['e'])) { ?>
                                        <div class="alert  alert-danger" role="alert">
                                            <?php echo  $_GET['e']; ?>
                                        </div>
                                    <?php } ?>
                                    <div class="form-floating mb-3">
                                        <input type="text" name="username" class="form-control form-control-sm" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Username</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control form-control-sm" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="d-flex flex-column mt-3">
                                        <input type="submit" value="Login" class="btn btn-primary" name="loginBtn">
                                    </div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </form>

                                <div class="mt-4 fw-bold">
                                    <a href="librarystaff.php">Library Staff Login Form</a> |
                                    <a href="teacher.php">Teacher Login Form</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
    if (isset($_POST['loginBtn'])) {
        loginStudent($_POST['username'], $_POST['password']);
    }

?>

<script>
const urlParams = new URLSearchParams(window.location.search);
const isModalOpen = urlParams.get('modal');

    if(isModalOpen == 'open') {
    var loginModal = new bootstrap.Modal(document.getElementById('loginModal'))
    loginModal.show();
    }
</script>




    