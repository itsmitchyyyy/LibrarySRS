<?php $activePage = basename($_SERVER['PHP_SELF'], ".php") ?>
<div class="container-fluid">
      <div class="row">
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'index') ? 'active' : '' ?>" href="index.php">
                  <span data-feather="users"></span>
                  Dashboard 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= (strpos($activePage, 'staff') !== false) ? 'active' : '' ?>" href="library-staff.php">
                  <span data-feather="users"></span>
                  Library Staff 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= (strpos($activePage, 'student') !== false) ? 'active' : '' ?>" href="students.php">
                  <span data-feather="users"></span>
                  Students 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?= (strpos($activePage, 'teacher') !== false) ? 'active' : '' ?>" href="teachers.php">
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
              <li class="nav-item">
                <a class="nav-link <?= ($activePage == 'categories') ? 'active' : '' ?>" href="categories.php">
                  <span data-feather="check-square"></span>
                  Categories
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">