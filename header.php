<?php if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>
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
            <div class="d-flex">
                <a class="navbar-brand" href="index.php">
                    <h3 style="color:black; display:inline-block;">
                        <img class="img-logo" src="images/apple-leaf.png" alt="Sustain image" style="width:50px; height:auto">SustainEnergy
                    </h3>
                </a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="activity.php">ACTIVITIES</a>
                    </li>
                    <li class="nav-item">
                        <?php if(isset($_SESSION['userid'])){
                            echo'<a class="nav-link" href="green_calc.php">GREEN CALCULATOR</a>})';
                        }else{
                            echo'<a class="nav-link" href="login.php">GREEN CALCULATOR</a>';
                        } ?>                      
                    </li>
                    <li class="nav-item">
                        <!-- Search bar -->
                        <form method="GET" action="search.php" class="d-flex">
                            <div class="input-group">
                                <input type="search" class="form-control" name="query" placeholder="Search for activities by name">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-outline-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </form>
                    </li>

                    <li class="nav-item">
                        <?php if(isset($_SESSION['userid'])) { ?>
                            <a class="nav-link" href="profile.php"><?php echo '<i class="fas fa-user" style="color:orange;"></i> '. $_SESSION['useruid']; ?></a>
                        <?php } else { ?>   
                            <a class="nav-link" href="signup.php">SIGN UP</a>
                        <?php } ?>
                    </li>

                    <!-- Dropdown menu-->
                    <li class="nav-item dropdown">
                      
                        <?php if(isset($_SESSION['userid'])) { ?>
                            <a class="nav-link" href="includes/logout.inc.php" class="header-login-a">LOGOUT</a>
                        <?php } else { ?>   
                            <a class="nav-link" href="login.php" class="header-login-a">LOGIN</a>
                        <?php } ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="loginDropdown">
                            <a class="dropdown-item" href="index.php">HOME</a>
                            <a class="dropdown-item" href="about.php">ABOUT</a>
                            <a class="dropdown-item" href="activity.php">ACTIVITIES</a>
                            <a class="dropdown-item" href="green_calc.php">GREEN CALCULATOR</a>
                            <?php if(isset($_SESSION['userid'])) { ?>
                                <a class="dropdown-item" href="includes/logout.inc.php">Logout</a>
                            <?php } else { ?>   
                                <a class="dropdown-item" href="login.php">Login</a>
                            <?php } ?>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </nav>
</header>
 
 <!-- Include Bootstrap JS and jQuery -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


 
</body>
</html>
