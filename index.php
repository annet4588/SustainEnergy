<?php
// include_once "includes/config.inc.php";
 include_once "header.php";  // Include the header with the navbar -->

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Include your head content here -->
</head>

<body class="d-flex flex-column vh-100"> <!-- vh-100 ensures full viewport height -->
  <!-- Main container-->
  <main class="flex-grow-1">
      <div class="d-flex container-fluid">
       <?php
        // Check if there's a message parameter in the URL passed from signup.php
        if(isset($_GET['message']) && $_GET['message'] == 'registered') {
            // Display the success message
            echo "<h6>You have now registered. Please login.</h6>";
        }
        ?>
        </div>
      <!-- Greeting to the logged user-->
      <div class="d-flex container-fluid">
        <?php
        if (isset($_SESSION['useruid'])) {
          echo "<h5>Welcome to SustainEnergy, " .  $_SESSION['useruid'] . "!</h5>";
        } else {
          echo "<h5>Welcome to SustainEnergy!</h5>";
        }
        ?>
      </div>
     
      <!-- Main image inside index page-->
      <div class="card">
        <img class="img-main img-fluid" src="images/sustainMain.jpeg" class="img-fluid">
        <div class="card-img-overlay d-flex justify-content-center align-items-center">
        <h2 class="card-title text-center" style="margin-top:100px; color:yellow;">Make Changes Help Our Planet!</h2>
        <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small>Last updated 3 mins ago</small></p> -->
  </div>
    </div>

      <!-- GOALS-->
    
    <div class="card flex-grow-1 p-3">
        <div id="our-mission" class="paragraph p-3">
            <div class="field field-name p-3">
                <h3>Our Goals</h3>
            </div>
            <div class="field field-name-description p-3">
                SustainEnergy endeavours to ignite a transformative movement within organisations, actively promoting and monitoring green initiatives to foster a vibrant culture of environmental responsibility and sustainability.
            </div>
            <div class="row d-flex p-3">
                <div class="col-sm-6 col-lg-3 d-flex p-3">
                    <a class="card card-height-fixed" href="about.php" title="Real-Time Impact">
                        <div class="card">
                        <img class="card-img-top" src="images/start-now2.jpeg" alt="Climate Action" style="height:170px;">
                        </div>
                        <div class="card-body">
                            <div class="card-title card-title-fixed-height">Real-Time Impact</div>
                            <div class="card-text paragraph pt-2 pb-2">
                                <p>Engage in immersive challenges, cutting-edge simulations, and collaborative missions to address pressing environmental issues such as carbon emmissions reduction and renewable energy projects.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 d-flex p-3">
                    <a class="card card-height-fixed" href="about.php" title="Creativity and Innovation">
                        <div class="card">
                            <img class="card-img-top" src="images/creative_img2.png" alt="Creativity Image" style="height:170px;">
                        </div>
                        <div class="card-body">
                            <div class="card-title card-title-fixed-height">Creativity and Innovation</div>
                            <div class="card-text paragraph pt-2 pb-2">
                                <p>Unleash your creativity and innovative spirit as you collaborate with like-minded individuals globally, leveraging technology and human ingenuity to forge a sustainable future.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 d-flex p-3">
                    <a class="card card-height-fixed" href="about.php" title="Community Engagement">
                        <div class="card">
                            <img class="card-img-top" src="images/community_eng.jpg" alt="Community Engagement" style="height:170px;">
                        </div>
                        <div class="card-body">
                            <div class="card-title card-title-fixed-height">Community Engagement</div>
                            <div class="card-text paragraph pt-2 pb-2">
                                <p>Participate actively in a dynamic community, enjoying exclusive perks, rewards, and recognition for your contributions, and envision the ripple effect of your actions on a global scale.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-3 d-flex p-3">
                    <a class="card card-height-fixed" href="about.php" title="Champion for the Planet">
                        <div class="card">
                            <img class="card-img-top" src="images/save_planet1.png" alt="Save Planet" style="height:170px;">
                        </div>
                        <div class="card-body">
                            <div class="card-title card-title-fixed-height">Champion for the Planet</div>
                            <div class="card-text paragraph pt-2 pb-2">
                                <p>Be at the forefront of the solution by joining the ultimate interactive experience and becoming a champion for our planet. Answer the call of the Earth with a resounding YES!</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

  <!--OUR MISSION -->

  <div class="card p-3">
    <div id="our-mission" class="paragraph-border">
        <div class="row">
            <div class="wrapper-infos col-lg-6">
                <div class="field field-name-title p-3">
                    <h3>Our Mission</h3>
                </div>
                <div class="field field-paragraph p-3">
                    <p>
                        Empower companies of all sizes to embrace environmental responsibility through our engaging activities. Receive recognition from a reputable professional body while actively contributing to driving support for green initiatives. Join us in making a meaningful difference for a sustainable future.
                    </p>
                </div>
                <div class="field field-button p-3">
                    <div class="field-item pb-3">
                        <?php if(isset($_SESSION['useruid'])){
                            echo '<a href="profile.php" class="btn btn-outline-success btn-arrow-right">
                            Join Us
                            </a>';
                            }else{
                             echo'<a href="signup.php" class="btn btn-outline-success btn-arrow-right">
                            Join Us
                            </a>';
                            }?>
                        
                    </div>
                </div>
            </div>
            <div class="wrapper-image col-lg-6">
                <div class="field field-name-image">    
                    <img class="img img-fluid img-goals" src="images/rewardSustain.jpg" width="700" height="400" alt="goals">         
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<!-- ACTIVITIES-->

<div class="card p-3">
    <div id="activities" class="paragraph">
        <div class="field field-name-title p-3">
            <h3>Activities</h3>
        </div>
        <div class="field field-name-description p-3">
        Are you ready to start an electrifying journey that puts YOU at the forefront of saving our precious planet? Step into the world of interactive eco-action where every click, every swipe, every choice you make has the power to make a monumental difference.
        </div>
        <div class="row justify-content-center p-3">
            <div class="col-sm-6 col-lg-3 text-center d-flex p-3">
                <a class="card card-height-fixed" href="activity.php" title="Activity Name">
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body" style="background-color:lightgrey;">
                        <img class="rounded-circle" src="activityImg/1carbEm.jpg" width="120" height="120" alt ="Carbon Emissions">
                        <div class="card-title card-title-fixed-height">Carbon Emissions Reduction</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="paragraph">Implementing energy-efficient practices, utilising renewable energy sources, and undertaking emission reduction initiatives to reduce carbon emissions.</p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Duplicate the above card structure three more times for a total of four columns -->
            <div class="col-sm-6 col-lg-3 text-center d-flex p-3">
                <a class="card card-height-fixed" href="activity.php" title="Second Card">
                    <!-- Content of the second card -->
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body" style="background-color:lightgrey;">
                        <img class="rounded-circle" src="activityImg/2renewEnergy.jpg" width="120" height="120" alt="Renewable Energy">
                        <div class="card-title card-title-fixed-height">Renewable Energy</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="paragraph">Increasing the percentage of energy consumption derived from renewable sources such as solar, wind, or hydropower.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3 text-center d-flex p-3">
                <a class="card card-height-fixed" href="activity.php" title="Third Card">
                    <!-- Content of the third card -->
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body"style="background-color:lightgrey;">
                        <img class="rounded-circle" src="activityImg/3wasteReduc.jpg" width="120" height="120" alt="Waste Reduction">
                        <div class="card-title card-title-fixed-height">Waste Reduction</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="paragraph">Minimising waste generation and increasing recycling rates through source reduction, recycling programs, and waste audits.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-lg-3 text-center d-flex p-3">
                <a class="card card-height-fixed" href="activity.php" title="Fourth Card">
                    <!-- Content of the fourth card -->
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body" style="background-color:lightgrey;">                      
                        <img class="rounded-circle" src="activityImg/4waterConserv.jpg" width="120" height="120" alt="Water Conservation">
                        <div class="card-title card-title-fixed-height">Water Conservation</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="paragraph">Implementing initiatives to reduce water consumption and promote water conservation practices in operations.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="align-items-start p-3">
                <a class="btn btn-outline-success" href="activity.php">More ...</a></div>
        </div>
    </div>
</div>

<!-- OUR PARTNERS-->

<div class="card justify-content-center p-3">
    <div id="our-partners" class="paragraph">
        <div class="field field-name-title p-3">
            <h3>Our Partners</h3>
        </div>
        <div class="field field-name-description p-3">
        Are you ready to start an electrifying journey that puts YOU at the forefront of saving our precious planet? Step into the world of interactive eco-action where every click, every swipe, every choice you make has the power to make a monumental difference.
        </div>
        <div class="row p-3">
            <div class="col-sm-12 col-lg-6 d-flex p-3">
                <a class="card card-height-fixed" href="https://en.unesco.org/sustainabledevelopmentgoals" title="UNESCO">
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body">
                        <img class="img img-partners" src="images/unesco-logo1.png" width="200" height="200" alt ="UNESCO">
                        <div class="card-title card-title-fixed-height">UNESCO</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="five-lines-paragraph">This initiative aligns with the GOALS outlined by UNESCO, underscoring its genuine and concentrated efforts towards fostering ecological preservation. </p>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Duplicate the above card structure three more times for a total of four columns -->
            <div class="col-sm-12 col-lg-6 d-flex p-3">
                <a class="card card-height-fixed" href="https://www.bcs.org/" title="BCS">
                    <!-- Content of the second card -->
                    <div class="card-arrow arrow-black"></div>
                    <div class="card-body">
                        <img class="img img-partners" src="images/BCS-Logo1.png" width="200" height="200" alt="BCS">
                        <div class="card-title card-title-fixed-height">British Computing Society</div>
                        <div class="card-text pt-2 pb-2">
                            <p class="five-lines-paragraph">We work in collaboration with the British Computer Society (BCS), who endorse our certificates, enabling companies to engage in sustainability initiatives and contribute positively to environmental preservation.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- OUR STORIES-->
<div class="card p-3">
<div id="our-stories" class="paragraph-border">
        <div class="row p-3">
        <div class="wrapper-image col-lg-6">
                <div class="field field-name-image">    
                    <img class="img img-fluid" src="images/ourStories.jpeg" width="700" height="400" alt="goals">         
                </div>
            </div>
            <div class="wrapper-infos col-lg-6">
                <div class="field field-name-title p-3">
                    <h3>Our Stories</h3>
                </div>
                <div class="field field-paragraph p-3">
                    <p>
                        Empower companies of all sizes to embrace environmental responsibility through our engaging activities. Receive recognition from a reputable professional body while actively contributing to driving support for green initiatives. Join us in making a meaningful difference for a sustainable future.
                    </p>
                </div>
                <div class="field field-button p-3">
                    <div class="field-item">
                        <a href="feedback.php" class="btn btn-outline-success btn-arrow-right">
                            Read Stories
                        </a>
                    </div>
                </div>
            </div>
           
            </div>
        </div>
</div>
    
      </main>

  <?php include_once "footer.php"; ?> <!-- Include your footer -->
</body>

</html>

<!--<h3 class="mission" style="padding-top:10px;">Our Mission</h3> -->

<!-- Search Bar code-->
<!-- <form method="GET" action="search.php" class="mb-4">
                <div class="input-group">
                    <input type="search" class="form-control" name="query" placeholder="Search for activities by name">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-success">Search</button>
                    </div>
                </div>
            </form> -->


<!--                    <div class="col-md-4 text-center">
                      <div class="card rounded-circle">
                        <img src="images/unesco-logo1.png" style="width:120px;height:120px;">
                      </div>
                     </div> -->
<!-- <div class="card p-3">
                     <div class="row">
                            <div class="col-md-4 text-center">
                              <div class="card rounded-circle">
                              
                                <h3 class="mission text-center">Engage</h3>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <div class="card-mission">
                                <img>
                              </div>
                            </div>
                        </div>
                    </div> -->