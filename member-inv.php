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
    <title>Website ni Lhanzy</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('member-nav.php'); ?>
    <div id="inv-cn">
        <div id="content">
            <h2><center>MEMBERS PAGE</center></h2>
            <div class="text-container">
                <h1>WelCOME ADMIN<br></h1>

                <p><br><b>Your Inventory</b></p>
                <img src="inventory.jpg" alt="inv" width="900" height="600">

            </div>			
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
