<?php include 'inc/header.php' ?>

<main class="justify-content-center d-flex align-items-center h-100">
    <form method="post" class="w-25" method="post">
        <div class="d-flex justify-content-center mb-5"><h4>Admin Login</h4></div>
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
</main>


<?php
    if (isset($_POST['loginBtn'])) {
        loginAdmin($_POST['username'], $_POST['password']);
    }

?>

<?php include 'inc/footer.php' ?>