<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header.php</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Include font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <!-- Include local stylesheet-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light">
     <div class="container-fluid p-2">
        <a class="navbar-brand" href="index.php"><h3 style="color:white;"><img src="images/logo.png" alt="Sustain image"> SustainEnergy</h3></a>        
        <ul class="menu-main">
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="activity.php">ACTIVITIES</a></li>
                <li><a href="green_calc.php">GREEN CALCULATOR</a></li>               
        </ul>
        
        <ul class="menu-member">
            <?php
            if(isset($_SESSION['userid'])) {
                ?>
                <li><a href="profile.php"><?php echo $_SESSION['useruid']; ?></a></li>
                <li><a href="includes/logout.inc.php"class="header-login-a">LOGOUT</a></li>
            <?php
            } else 
            {           
            ?>   
            <li><a href="signup.php" class="header-login-a">SIGN UP</a></li>      
            <li><a href="login.php" class="header-login-a">LOGIN</a></li> 
            <?php
            }
            ?>
        </ul>
    </div>
    </nav>
</header>
<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

