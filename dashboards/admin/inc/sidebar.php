<?php $activePage = basename($_SERVER['PHP_SELF'], ".php") ?>
<div class="container-fluid">
      <div class="row">
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'students') ? 'active' : '' ?>" href="students.php">
                  <span data-feather="users"></span>
                  Students 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'teachers') ? 'active' : '' ?>" href="teachers.php">
                  <span data-feather="users"></span>
                  Teachers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'books') ? 'active' : '' ?>" href="books.php">
                  <span data-feather="book"></span>
                  Books
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'reservations') ? 'active' : '' ?>" href="reservations.php">
                  <span data-feather="check-square"></span>
                  Reservations
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">