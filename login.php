<?php
include_once "header.php";
?>

<body class="d-flex flex-column vh-100"> 
<main class="container mt-5 flex-grow-1">
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh;">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Login</h5>
                <?php
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger">';
                    foreach ($errors as $error) {
                        echo "<p>$error</p>";
                    }
                    echo '</div>';
                }
                ?>
                <form method="POST" action="includes/login.inc.php"> <!-- Add method and action -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter email"> <!-- Add name attribute -->
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password"> <!-- Add name attribute -->
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember login</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <div class="mt-3 text-center">
                    <p><a href="signup.php">Create an account</a></p>
                    <?php
                    if(isset($_GET["newPwd"])){
                        if($_GET["newPwd"] == "passwordupdated"){
                            echo '<p class="signupsuccess">Your password was been reset!</p>';
                        }
                    }
                    ?>
                    <p><a href="forgot_password.php">Forgot password?</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
<?php
include_once "footer.php";
?>