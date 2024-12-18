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
        <div id="container">
            <h2><center>Change Pass</center></h2>
                <div class="form-group">
                    <p><label class="label" for="psword1">New Password:</label>
                    <input type="text" id="psword1" name="psword1" size="30" maxlength="40" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>">
                    </p>
                <p><input type="submit" id="submit" name="submit" value="Change"></p>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
