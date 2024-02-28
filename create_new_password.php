<?php
include_once "header.php";
?>

<body class="d-flex flex-column vh-100"> 
<main class="container mt-5 flex-grow-1">
<section class="center-card">
    <div class="card activity-bg activity-card">
        <div class="activity-body activity-info">
           <?php
            $selector = $_GET["selector"];
            $validator = $_GET["validator"];

            if(empty($selector || empty($validator))){
                echo "Could not validate your request!";
            }else{
                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                 ?>
                <form action="includes/reset_password.inc.php" method="post">
                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                    <input type="password" name="pwd" placeholder="Enter a new password">
                    <input type="password" name="pwd-repeat" placeholder="Repeat new password">
                    <button type="submit" name="reset_password_submit">Reset password</button>
                </form>
                <?php
                }
            }
           ?>
        </div>
    </div>
</section>
</main>
</body>
<?php
include_once "footer.php";
?>
