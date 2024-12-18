
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website ni Lhanzy</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>
<div id="container">
<?php
session_start(); // Start the session at the beginning of the page

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('mysqli_connect.php');

    // Email and Password validation
    if (empty($_POST['email'])) {
        echo '<p class="error">Email is required</p>';
    } else {
        $e = trim($_POST['email']);
    }

    if (empty($_POST['psword'])) {
        echo '<p class="error">Password is required</p>';
    } else {
        $p = trim($_POST['psword']);
    }

    // If email and password are provided, continue
    if ($e && $p) {
        //get info based on email
        $q = "SELECT user_id, fname, user_level, psword FROM users WHERE email = '$e'";
        $result = @mysqli_query($dbcon, $q);

        // Checker
        if (@mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Verify the password
            if (password_verify($p, $row['psword'])) {
                $_SESSION['user_id'] = $row['user_id']; // Store user ID in session
                $_SESSION['user_level'] = $row['user_level']; // 1 for admin, 0 for member

                // Redirect based on user level
                if ($_SESSION['user_level'] == 1) {
                    
                    header('Location: admin-page.php');
                    exit();
                } else {
                    
                    header('Location: member-page.php');
                    exit();
                }
            } else {
                // Password doesn't match
                echo "<p class='error'>Invalid password</p>";
            }

            // Free the result and close the connection
            mysqli_free_result($result);
        } else {
            // User doesn't exist
            echo "<p class='error'>No user found with this email</p>";
        }
    }

    // Close the database connection
    mysqli_close($dbcon);
}
?>

<div id="loginfields">
<?php include('login_page.inc.php'); ?>
</div><br>
</div>
</body>
<?php include('footer.php'); ?>
</html>
