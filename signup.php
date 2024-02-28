<?php
include_once "header.php";
?>

<body class="d-flex flex-column vh-100"> 
<main class="container mt-5 flex-grow-1">
<div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh;">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create an Account</h5>
            <?php if (isset($errorMessage)) : ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <form method="post" action="includes/signup.inc.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Create password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="pwdrepeat" name="pwdrepeat" placeholder="Confirm password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create Account</button>
            </form>
            <div class="mt-3 text-center">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>
</div>
</main>
</body>
<?php
include_once "footer.php";
?>


