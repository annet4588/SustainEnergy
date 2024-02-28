<?php
include_once "header.php";

//Access to the classes in order to grab info
include_once "classes/dbh.classes.php";
include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-contr.classes.php";
include_once "classes/profileinfo-view.classes.php";
$profileInfo = new ProfileInfoView();
?>

<section class="center-card">
    <div class="card profile-bg profile-card">
        <div class="card-body profile-info">
            <div class="profile-info-img">
                <p>
                    <?php
                       echo $_SESSION["useruid"];
                    ?>	
                </p>
                <div class="break"></div>
                <a href="profile_settings.php" class="follow-btn">PROFILE SETTINGS</a>
            </div>
            <div class="card-body profile-info-img">
                <h3>ABOUT</h3>
                <p>
                    <?php
                    //Grab the method we created in profileinfo-view class and pass the SESSION var
                    $profileInfo->fetchAbout($_SESSION["userid"]);
                    ?>				
                </p>
                <h3>FOLLOWERS</h3>
                <h3>FOLLOWING</h3>
            </div>
        </div>
    </div>

    <div class="card profile-bg profile-card">
        <div class="card-body profile-content">
            <div class="card-body profile-intro">
                <h3>
                    <?php
                    //Grab the method we created in profileinfo-view class and pass the SESSION var
                    $profileInfo->fetchTitle($_SESSION["userid"]);
                    ?>	
                </h3>
                <p>
                    <?php
                        //Grab the method we created in profileinfo-view class and pass the SESSION var
                        $profileInfo->fetchText($_SESSION["userid"]);
                    ?>	
                </p>
            </div>
        </div>
    </div>

    <div class="card profile-bg profile-card">
        <div class="card-body profile-posts">
            <h3>POST</h3>
            <div class="profile-post">
                <h2>IT IS NICE WEATHER OUTSIDE</h2>
                <p>Text you like</p>
                <p>12:45 - 24/11/2023</p>
            </div>
            <div class="profile-post">
                <h2>RECYCLING IS A GOOD IDEA</h2>
                <p>Text you like</p>
                <p>16:15 - 25/11/2023</p>
            </div>
        </div>
    </div>
</section>

    <style>
  .center-card {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust as needed */
    }

    .card {
        width: 300px; /* Adjust as needed */
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin: 0 10px;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-body {
        padding: 20px;
    }

    .profile-info {
        /* Existing styles for profile-info */
        width: 100%; /* Adjust as needed */
        margin-bottom: 10px; /* Add margin for separation */
    }

    .profile-content {
        /* Existing styles for profile-content */
        width: 100%; /* Adjust as needed */
        margin-bottom: 10px; /* Add margin for separation */
    }

    .profile-post {
        /* Existing styles for profile-post */
        width: 100%; /* Adjust as needed */
    }
    </style>
</body>
</html>