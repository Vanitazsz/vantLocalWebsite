<?php
session_start();  // Start the session

// Check if the user is logged in and has the correct user level
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// If the user is not an admin (user_level !== 1), redirect them to member page
if ($_SESSION['user_level'] != 1) {
    header('Location: member-page.php');
    exit();
}
// Enable error reporting for debugging (optional)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
require("mysqli_connect.php");

// Check if the user ID is passed via GET and is valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user data from the database
    $query = "SELECT user_id, fname, lname, email FROM users WHERE user_id = $user_id";
    $result = mysqli_query($dbcon, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['fname'];
        $last_name = $row['lname'];
        $email = $row['email'];
    } else {
        echo "User not found!";
        exit;
    }
} else {
    echo "Invalid User ID!";
    exit;
}

// Handle form submission when the form is submitted (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the updated form data
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];

    // Validation for empty fields
    if (empty($first_name) || empty($last_name) || empty($email)) {
        echo "Please fill in all fields.";
    } else {
        // Update user data in the database
        $query = "UPDATE users SET fname = ?, lname = ?, email = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($dbcon, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $first_name, $last_name, $email, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "User updated successfully!";
            echo'
                            <div class = back-button>
                            <a href="register-view-users.php" class="register"> <p>&nbsp</p>Go Back</a>
                            </div>';
            exit;
        } else {
            echo "Error updating user: " . mysqli_error($dbcon);
        }
    }
}

// Close the database connection at the end of PHP logic
mysqli_close($dbcon);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Info - Website ni Lhanzy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <?php include('header.php'); ?>
        <?php include('admin-nav.php'); ?>

        <div id="content">
            <h2><center>Edit User Info</center></h2>
            <div class="text-container">
                <!-- Form for editing user -->
                <form action="edit-user.php?id=<?php echo $user_id; ?>" method="post">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="<?php echo htmlspecialchars($first_name); ?>" required><br><br>

                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="<?php echo htmlspecialchars($last_name); ?>" required><br><br>

                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

                    <input type="submit" value="Update User">
                </form>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
