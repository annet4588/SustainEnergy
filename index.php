<?php
include_once "header.php";
?>
<body class="d-flex flex-column vh-100"> <!-- vh-100 ensures full viewport height -->
<main class="container mt-5 flex-grow-1">
     <!-- Greeting to the logged user-->
    <?php
    if (isset($_SESSION["uid"])) {
        echo "<h2>Welcome to SustainEnergy, " . $_SESSION["uid"] . "!</h2>";
    } else {
        echo "<h2>Welcome to SustainEnergy!</h2>";
    }
    ?>
    <p><h4>Discover Sustainability Activities</h4></p>
    <!-- Search Bar code-->
    <form method="GET" action="search.php" class="mb-4">
        <div class="input-group">
            <input type="search" class="form-control" name="query" placeholder="Search for activities by name">
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-success">Search</button>
            </div>
        </div>
    </form>
    <div class="card">
     <img class="img_main" src="images/greenEnergy.png">
    </div>

    <div>Text about</div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</main>
</body>
<?php
include_once "footer.php";
?>