
<?php
session_start();


if (!isset($_SESSION['role']) || isset($_SESSION['role']) && $_SESSION['role'] != 'admin') { 
  header('location: ../../index.php');
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/custom.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
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

        .footerContainer {
            height: 100px;
            background: #295ba5;
            color: #fff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow" style="background-color: #295ba5 !important">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#signOutModal">Sign out</a>
        </li>
      </ul>
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


    