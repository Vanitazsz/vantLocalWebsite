<?php
session_start();  // Start the session

// Check if the user is logged in and has the correct user level
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Members Page</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('member-nav.php'); ?>
    <div id="container">
        <div id="content">
            <h2><center>MEMBER PAGE</center></h2>
            <div class="memp-cn">
                <h1>Welcome Member</h1>
                <p>Your member content here...</p>
                <img src="stats.jpg" alt="stats" width="900" height="600">
            </div>			
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
