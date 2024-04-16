<?php
include_once "header.php";
include_once 'helpers/session_helper.php';
?>


<body class="d-flex flex-column vh-100">
    <main class="login-container mt-5 flex-grow-1" style="background-image: url('images/nature1.jpg');">
        <div class="container d-flex justify-content-center align-items-start" style="min-height: 100vh; width: 400px">
            <div class="card card-login p-3" style="margin-top:50px">
                <div class="card-body m-1">
                    <h5 class="card-title">Forgot Password</h5>

                    <?php flash('reset'); ?>

                    <p class="form-group">An email will be sent to you with instructions on how to reset your password.</p>
                    <form action="classes/reset_password-contr.classes.php" method="post">
                        <input type="hidden" name="type" value="send">
                        <div class="form-group">
                            <input type="text" name="users_email" placeholder="Enter your email address...">
                            <button type="submit" class="btn btn-primary btn-block" name="reset-request-submit">Submit</button>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST["reset"]) && $_POST["reset"] == "success") {
                    flash('reset', 'Check your email!', 'form-message form-message-green');
                } elseif (isset($_POST["reset"])) {
                    flash('reset', 'An error occurred while resetting your password. Please try again later.', 'form-message form-message-red');
                }
                ?>
            </div>
        </div>
    </main>
</body>
<?php
include_once "footer.php";
?>
<style>
    .form-message {
        margin: 5px auto 0 auto;

        border-radius: 8px;
        text-transform: capitalize;
        width: 70%;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;

        p {
            text-align: center;
            font-size: 1.6rem;
        }
    }

    .form-message-red {
        background-color: #ffb3b3;
        border: 2px solid #ff0000;
        width: 300px;
    }

    .form-message-green {
        background-color: lightgreen;
        border: 2px solid green;
        width: 300px;
    }
</style>