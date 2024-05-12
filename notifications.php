<?php
include_once 'header.php';

echo '<div class="container text-center mt-4" style="min-height: 100vh;">';
echo '<h3 class="text-center mt-4 p-3">Notifications</h3>';
echo '<div class="row justify-content-center p-3">';
echo '<div class="col-md-8">';
echo '<div class="card mt-3">';
echo '<div class="card-body">';
echo '<h5 class="card-title text-center">Your Notifications</h5>';
echo '<div class="text-center">';
echo '<div class="alert alert-success" role="alert">';
echo '<p>You do not have any notifications.</p>'; 
// Choose Notification Form 
echo '
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h4>Choose your Preference</h4>
            <form method="POST" action="includes/profileinfo.inc.php">
                <!-- Include a hidden input field for the profile ID -->
                <input type="hidden" name="profiles_id" value="<?php echo $profileId; ?>">
                <div class="form-group">
                    <label for="company_name">Sustainability Updates</label>
                    <select class="form-control">
                        <option value>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>     
                    </select>
                </div>
                <div class="form-group">
                    <label for="first_name">New Activities</label>
                    <select class="form-control">
                        <option value>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>     
                    </select>
                </div>
                <div class="form-group">
                    <label for="last_name">Latest Events</label>
                    <select class="form-control">
                        <option value>Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>     
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-success mt-3" name="update_profile">Choose</button>
                </div>
            </form>
        </div>
    </div>
</div>';

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '</div>'; 
echo '</div>';
include_once "footer.php";