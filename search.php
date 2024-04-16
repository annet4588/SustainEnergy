<?php 
include_once "header.php";
include_once "classes/dbh.classes.php";
include_once "classes/search.classes.php";

//Query to find Activity
if(isset($_GET['query'])){
    $query = $_GET['query'];
   
    //Get instance from Search class
    $search = new Search();

    //Call method search Activity
    $results = $search->searchActivity($query);

    //Display the searching Activity
    if(count($results) > 0){
        echo '<div class="container mt-5 justify-content-center">';
        echo '<h2>Search Results</h2>';
        echo '<div class="row">';

        foreach($results as $row){
          echo '<div class="col-md-4 mb-4">
                 <div class="card activity-bg activity-card">
                   <div class="card-body activity-info">
                     <img src="activityImg/' . $row['activity_img'] . '" class="img-fluid fixed-height-image" alt="' . $row['activity_name'] . '">
                     <h5 class="card-title mt-3" style="max-height: 3em; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $row['activity_name'] . '</h5>
                     <a href="activityinfo.php?activity_id='. $row['activity_id'] . '" class="btn btn-outline-success">More Details</a>
                   </div>
                 </div>
               </div> ';
       }
        echo '</div>';
        echo '</div>';
    }else{
        echo '<div class="container mt-5">';
        echo '<h2>No results found for your query: ' . htmlspecialchars($query) . '</h2>';
        echo '</div>';
    }
}

$stmt = null;

include_once "footer.php";
