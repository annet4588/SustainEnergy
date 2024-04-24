<?php
ob_start(); // Start output buffering
include_once "header.php";
require_once "classes/dbh.classes.php";
require_once 'helpers/session_helper.php';
include "classes/login.classes.php";
include "classes/login-contr.classes.php";


$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) { // Add condition to check if the form has been submitted
    try {
        $uid = htmlspecialchars($_POST['uid'], ENT_QUOTES, 'UTF-8');
        $pwd = htmlspecialchars($_POST['pwd'], ENT_QUOTES, 'UTF-8');

        if (filter_var($uid, FILTER_VALIDATE_EMAIL)) {
            $email = $uid;
            $username = null;
        } else {
            $username = $uid;
            $email = null;
        }
        
        $login = new LoginContr($uid, $pwd);
        $login->processLogin();
        $errors = $login->getErrors();

        if (!empty($errors)) {
            throw new Exception("Login failed: " . implode(", ", $errors));
        }

        // Redirect to index.php after successful login
        header("location: index.php?login=success");
        exit(); // Ensure script stops executing after redirect

    } catch (Exception $e) {
        // Handle exceptions here
        // $errors[] = $e->getMessage();
    }
}
?>

<body class="d-flex flex-column vh-100"> 
<main class="login-container mt-5 pb-5 flex-grow-1" style="background-image: url('images/nature1.jpg');">
    <div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh; width: 400px">
        <div class="card card-login p-3" style="margin-top:50px">
            <div class="card-body m-3">
                <h5 class="card-title">Login</h5>
                <?php
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger">';
                    foreach ($errors as $error) {
                        echo '<p>' . htmlspecialchars($error) . '</p>';
                    }
                    echo '</div>';
                }
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="uid" name="uid" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember login</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="submit">Login</button>
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
ob_end_flush(); // Flush the output buffer

