<?php
include_once 'header.php';
?>
<body class="d-flex flex-column vh-100">
<main class="flex-grow-1">

    <section class="center-card">

    <div class="container-fluid p-3">
    <h3 class="text-center p-3">About Us</h3>
    <div class="card p-3">
    <div id="our-mission" class="paragraph-border">
        <div class="row">
            <div class="wrapper-infos col-lg-6 p-3">
                <div class="field field-name-title p-3">
                    <h3>Who We are</h3>
                </div>
                <div class="field field-paragraph p-3 pb-2">
                <p> SustainEnergy is a web-based platform designed for companies to subscribe and engage in sustainable practices. Our goal is to encourage and monitor green activities, fostering environmental responsibility. We focus on delivering a seamless user experience with a visually appealing interface, prioritising engagement, streamlined processes, security, and accessibility for all users.</p>
                <p> Are you ready to start an electrifying journey that puts YOU at the forefront of saving our precious planet? Step into the world of interactive eco-action where every click, every choice you make has the power to make a monumental difference.</p>
            <p> Experience the thrill of real-time impact as you dive into immersive challenges and collaborative missions designed to tackle the most pressing environmental issues of our time. From reforestation initiatives to renewable energy projects, your participation isn't just encouraged—it's essential!</p>
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
                <div class="field field-name-image mt-5 pt-3">    
                    <img class="img img-fluid img-goals" src="images/sustainbulb.jpg" width="700" height="400" alt="goals">         
                </div>
            </div>
            </div>
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
                        <img class="card-img-top" src="images/start-now2.jpeg" alt="Climate Action">
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
                            <img class="card-img-top" src="images/creative_img2.png" alt="Creativity Image">
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
                            <img class="card-img-top" src="images/community_eng.jpg" alt="Community Engagement">
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
                            <img class="card-img-top" src="images/save_planet1.png" alt="Save Planet">
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
        <div class="wrapper-image col-lg-6">
                <div class="field field-name-image">    
                    <img class="img img-fluid img-goals" src="images/rewardSustain.jpg" width="700" height="400" alt="goals">         
                </div>
            </div>
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
         
            </div>
        </div>
    </div>
</div>
</section>
</main>
</body>

<?php
include_once "footer.php";
?>