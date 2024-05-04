<?php
include_once 'header.php';
include_once './helpers/session_helper.php';

// Retrieve selector and validator from the URL
$selector = $_GET['selector'] ?? null;
$validator = $_GET['validator'] ?? null;

// var_dump($selector, $validator);

if (empty($selector) || empty($validator)) {
    echo 'Could not validate your request!';
} else {
    // Check if selector and validator are hexadecimal strings
    if (ctype_xdigit($selector) && ctype_xdigit($validator)) {
        ?>
        <body class="d-flex flex-column vh-100">
        <main class="login-container mt-5 flex-grow-1"
              style="background-image: url('images/nature1.jpg');">
            <div class="container d-flex justify-content-center align-items-start"
                 style="min-height: 100vh; width: 400px">
                <div class="card card-login p-3" style="margin-top:50px">
                    <div class="card-body m-3">
                        <h5 class="card-title">Enter New Password</h5>

                        <?php flash('newReset') ?>

                        <form action="classes/reset_password-contr.classes.php" method="post">
                            <input type="hidden" name="type" value="reset"/>
                            <input type="hidden" name="selector" value="<?php echo $selector ?>"/>
                            <input type="hidden" name="validator" value="<?php echo $validator ?>"/>
                            <div class="form-group">
                                <label for="pwd">New Password</label>
                                <input type="password" class="form-control" id="pwd" name="pwd"
                                       placeholder="Enter a new password...">
                            </div>
                            <div class="form-group">
                                <label for="pwd-repeat">Repeat New Password</label>
                                <input type="password" class="form-control" id="pwd-repeat" name="pwd-repeat"
                                       placeholder="Repeat new password...">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
                        </form>
                      
                    </div>
                </div>
            </div>
        </main>
        </body>

        <?php
        include_once 'footer.php';
    } else {
        echo 'Could not validate your request!';
    }
}
?>
<style>
    .form-message{
    margin: 5px auto 0 auto;

    border-radius: 8px;
    text-transform: capitalize;  
    width: 70%;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    p{
        text-align: center;
        font-size: 1.6rem;
    }
}
    .form-message-red{   
    background-color: #ffb3b3;
    border: 2px solid #ff0000;
    width: 300px;
}

.form-message-green{
    background-color: lightgreen;
    border: 2px solid green;
    width: 300px;
}
</style>