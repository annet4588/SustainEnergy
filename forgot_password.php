<?php
include_once "header.php";
?>

<body class="d-flex flex-column vh-100"> 
<main class="container mt-5 flex-grow-1">
<section class="center-card">
    <div class="card activity-bg activity-card">
        <div class="activity-body activity-info">
            <h2>Forgot password</h2>
            <p>An email will be sent to you with instructions on how to reset your password.</p>
            <form action="includes/reset-request.inc.php" method="post">
                <input type="text" name="email" placeholder="Enter your email address..."> 
                <button type="submit" name="reset-request-submit">Submit</button>
            </form>
            <?php
            if(isset($_GET["reset"])){
                if($_GET["reset"]=="success"){
                    echo '<p class="signupsuccess">Check your email!</p>';
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
