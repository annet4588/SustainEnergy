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
$userDeleted = false;
// Create an instance of SignupContr class
$signupContr = new SignupContr(null, null, null, null);
// Fetch users from the database
$users = $signupContr->fetchAllUsers();
// var_dump($users);

// Handle user removal
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userId"])) {
    // Get the user ID to be removed from the form submission
    $userIdToRemove = $_POST["userId"];

   // Delete the user from the database
    try {
        $signupContr->removeUser($userIdToRemove); // Pass userId directly
        $userDeleted = true;
    } catch (Exception $e) {
        // Handle any errors that occur during user removal
        echo "Error removing user: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h2>Admin Page</h2>
    <?php
    // Display message if a user was successfully deleted
    if ($userDeleted) {
        echo '<div class="alert alert-info m-3">
                <p>The user was deleted successfully!</p>
            </div>';
    }
    ?>
    <table id="userTable">
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr id="userRow_<?php echo $user["users_id"]; ?>">
                <td><?php echo $user["users_id"]; ?></td>
                <td><?php echo $user["users_uid"]; ?></td>
                <td><?php echo $user["users_email"]; ?></td>
                <td>
                    <form id="removeForm_<?php echo $user["users_id"]; ?>" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                        <input type="hidden" name="userId" value="<?php echo $user["users_id"]; ?>">
                        <button type="submit" class="btn btn-outline-success removeBtn" onclick="handleSubmit(event, <?php echo $user['users_id'];?>)">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
<?php include_once "footer.php"; ?>


<!-- Include Bootstrap JS and jQuery -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Function to handle form submission
    function handleSubmit(event, userId) {
        // Prevent the default form submission behavior
        event.preventDefault();
        
        // Get the form ID from the event
        var formId = event.target.form.id;
        
        // Show confirmation dialog
        if (confirm('Are you sure you want to remove this user?')) {
            // If confirmed, submit the form
            document.getElementById(formId).submit();
        } else {
            // If canceled, do nothing
            return;
        }
    }
</script>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        button {
            padding: 8px 12px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>