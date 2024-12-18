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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('admin-nav.php'); ?>
    <div id="container">
        <div id="content">
            <h2><center>ADMIN PAGE</center></h2>
            <div class="admin-cn">
                <p>Welcome Admin</p>
                <img src="dashboard.jpg" alt="dashboard" width="900" height="600">
                <p>Your admin content here...</p>
            </div>			
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
