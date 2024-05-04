<?php include_once "header.php"; ?>

<body>
    <div class="container p-4">
        <h3 class="pb-3">Getting Started Guide:</h3>
        <h4 class="pb-3"> Embrace Environmental Responsibility with Green Activities</h4>
        <p>Welcome to our platform for embracing environmental responsibility through engaging activities!</p>
        <p>Here's a step-by-step guide to get started:</p>

        <h3>1. Subscribe:</h3>
        <p>To participate in our Green Activities, you need to subscribe by paying a subscription fee of £99.</p>

        <h4>How to Subscribe:</h4>
        <ul>
            <?php if(isset($_SESSION["useruid"])){
                echo '<li>Go to your <a href="profile.php">Profile page</a>.</li>';
            } else{
                echo '<li>Go to your <a href="login.php">Profile page</a>.</li>';
            }?>
            
            <li>Click on the "Subscribe" button.</li>
            <li>Follow the instructions to complete the payment process and enable access to start your journey.</li>
        </ul>

        <h3>2. Taking Part in Green Activities:</h3>
        <p>To begin your journey towards environmental responsibility, follow these steps:</p>

        <p>Visit the <?php if(isset($_SESSION["useruid"])){
             echo'<a href="green_calc.php">Green Calculator page</a>';     
        }else{
            echo'<a href="login.php">Green Calculator page</a>'; 
        }?> and carefully read the instructions provided.</p>

        <h4 class="pb-3">Choosing Green Activities:</h4>
        <ul>
            <li>Choose 10 Green Activities that you're interested in.</li>
            <li>Use the "ADD" button to add them to your list.</li>
            <li>If you change your mind, you can remove activities from the list using the "DELETE" button.</li>
        </ul>

        <h4 class="pb-3">Scoring Your Activities:</h4>
        <p>Once you've chosen all 10 activities, select a score for each activity to assess your progress towards the goal of 100 points.</p>
        <p>Your total score will be calculated automatically.</p>

        <h3 class="pb-3">3. Receiving Your Certificate:</h3>
        <p>If you achieve 100 points, you can receive a Certificate.</p>
        <button>Click here to view and download your Certificate</button>
        <p>If you don't achieve 100 points initially, don't worry!</p> 
        <p>You can still receive a Certificate by donating to purchase a voucher for the remaining points.</p>
        <button>Click here to proceed with donation</button>

        <h4 class="pb-3 pt-3">Viewing Your Certificate:</h4>
        <p>After receiving your Certificate, you can view it in the Achievement section of your Profile page.</p>
        <button>Click here to view your Certificate</button>

        <div class="signup-button">
            <p>Join us in making a meaningful difference for a sustainable future! <a href="http://localhost/sustainenergy/signup.php"><button>Sign up now</button></a> to get started.</p>
        </div>

        <h5 class="text-center p-3">Thank you for choosing to embrace environmental responsibility with us!</h5>  
        <h5 class="text-center p-3">Together, we can create a more sustainable world!</h5>
    </div>
</body>

<?php include_once "footer.php"; ?>