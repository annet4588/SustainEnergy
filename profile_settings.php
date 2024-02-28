<?php
include_once "header.php";

//Access to the classes in order to grab info
include_once "classes/dbh.classes.php";
include_once "classes/profileinfo.classes.php";
include_once "classes/profileinfo-view.classes.php";
$profileInfo = new ProfileInfoView();
?>
<body>
<section class="center-card">
    <div class="card profile-bg profile-card">
        <div class="card-body profile-info">
           <h3>Profile Settings</h3>
           <p>Change your about section here!</p>
        <form action="includes/profileinfo.inc.php" method="post">
            <textarea name="about" row="10" cols="30" placeholder="Profile about section ..."><?php $profileInfo->fetchAbout($_SESSION["userid"]);?></textarea>
            <br><br>
            <p>Change your profile page intro here!</p>
            <br>
            <input type="text" name="introtitle" placeholder="Profile title ..." value="<?php $profileInfo->fetchTitle($_SESSION["userid"]);?>">
            <textarea name="introtext" rows="10" cols="30" placeholder="Profile introtext section ..."><?php $profileInfo->fetchText($_SESSION["userid"]);?></textarea>
            <button type="submit" name="submit">SAVE</button>
        </form>
        </div>
    </div>    
</section>

   
</body>
</html>
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