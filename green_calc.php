<?php
include_once 'header.php';
include_once "classes/dbh.classes.php";
include_once "classes/activityinfo.classes.php";
include_once "classes/activityinfo-contr.classes.php";
include_once "classes/activityinfo-view.classes.php";

$activityInfo = new ActivityInfoView();
$activityIds = $activityInfo->fetchActivityId();
?>

<body class="d-flex flex-column vh-100"> 
    <main class="container mt-5 flex-grow-1">
        <section class="center-card">
            <div class="card activity-bg activity-card">
                <div class="activity-body activity-info">
                    <h2>Green Calculator</h2>
                </div>
                <?php foreach($activityIds as $activityId): 
                  ?>
                    <div class="card-body activity-info">
                        <form action="includes/activityinfo.inc.php" method="post"> 
                        <div class="table-responsive-sm">
                            <table>
                            
                                <thread>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Activity Name</th>
                                    <th scope="col">Score</th> 
                                    </tr>
                               </thread>
                               <tbody>
                               <th scope="row">1</th>
                               <td><img src="activityImg/<?php echo $activityInfo->fetchActivityImage($activityId); ?>" class="img-fluid" alt="Activity Image">
                            <h5 class="card-title mt-3">
                                <?php echo $activityInfo->fetchActivityName($activityId); ?>
                            </h5>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-outline-success" name="add_activity">ADD</button>
                                <button type="submit" class="btn btn-outline-success" name="delete_activity">DELETE</button>
                                
                            </div></td>
                            
                            </tbody>
                           
                          </table>
                         </div>
                        </div>
                        </form>
                    
                <?php
               
             endforeach; ?>
            </div>
        </section>
    </main>
</body>

<?php
include_once "footer.php";
?>

<style>
    .img-fluid{
        height: 100px;
        width: auto;
    }
</style>