<?php
ob_start(); // Start output buffering
// Include necessary files and start session
require_once "header.php";
require_once "classes/dbh.classes.php";
require_once "classes/signup.classes.php";
require_once "classes/signup-contr.classes.php";

// Check if the user is logged in as an admin
if (!isset($_SESSION["isAdmin"]) || $_SESSION["isAdmin"] !== true) {
    // Redirect to login page if not logged in as admin
    header("Location: login.php");
    exit();
}

// Create an instance of SignupContr class
$signupContr = new SignupContr(null, null, null, null);

// Handle user removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["adminBtn"])) {
    // Get the user ID to be removed from the form submission
    $userIdToRemove = $_POST["users_id"];

    // Delete the user from the database
    $signupContr->removeUser($userIdToRemove);
    var_dump($userIdToRemove);

    // After deleting the user, redirect back to the admin page
    header("Location: admin.php");
    exit();
}

// Fetch users from the database
$users = $signupContr->fetchAllUsers();
// var_dump($users);
// Display users
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Admin Page</h1>
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user["users_id"]; ?></td>
                <td><?php echo $user["users_uid"]; ?></td>
                <td><?php echo $user["users_email"]; ?></td>
                <td>
                <form id="removeForm_<?php echo $user["users_id"]; ?>" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <input type="hidden" name="users_id" value="<?php echo $user["users_id"]; ?>">
                        <button type="submit" class="btn btn-outline-success removeBtn" name="remove_user" onclick="confirmRemove(<?php echo $user["users_id"];?>)">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php include_once "footer.php"; ?>
<script>
     
        function confirmRemove(userId) {
            if (confirm('Are you sure you want to remove this user?')) {
                document.getElementById('removeForm_' + userId).submit();
                
            }
        }
    
</script>