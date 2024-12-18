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
    <title>Delete Record - Project Vanitas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('admin-nav.php'); ?>
    <div id="container">
        <div id="delete">
            <h2><center>D e l e t e - R e c o r d</center></h2>
            <?php
                // Check if we have a valid ID either from GET or POST
                if ((isset($_GET["id"]) && (is_numeric($_GET["id"])))) {
                    require("mysqli_connect.php");
                    $id = $_GET["id"];
                } elseif ((isset($_POST["id"]) && (is_numeric($_POST["id"])))) {
                    require("mysqli_connect.php");
                    $id = $_POST["id"];
                } else {
                    echo "Invalid ID";
                    exit; // Stop execution if ID is invalid
                }

                // Handle the POST request to confirm deletion
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($_POST['sure'] == 'Yes') {
                        // Correct the query to use the valid $id
                        $query = "DELETE FROM users WHERE user_id = $id"; 
                        $result = @mysqli_query($dbcon, $query);
                        
                        // Check if the deletion was successful
                        if (mysqli_affected_rows($dbcon) == 1) {
                            echo "Delete Successful";
                            echo'
                            <div class = back-button>
                            <a href="register-view-users.php" class="register"> <p>&nbsp</p>Go Back</a>
                            </div>';
                        } else {
                            echo "Error Deleting Record";
                        }
                    } else {
                        echo "Record not deleted.";
                        echo'
                        <div class = back-button>
                        <a href="index.php" class="back-to-top"> Go Back</a>
                        </div>';
                    }
                } else {
                    // Fetch the user data to confirm deletion
                    $q = "SELECT CONCAT(fname, ' ', lname) FROM users WHERE user_id = $id";
                    $result = @mysqli_query($dbcon, $q);
                    
                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        echo "Are you sure you want to delete the following user? <br><strong>" . $row[0] . "</strong>";
                        echo '
                        <form action="delete-user.php" method="post">
                            <input type="submit" name="sure" value="Yes" class="button-confirm">
                            <input type="submit" name="sure" value="No" class="button-confirm">
                            <input type="hidden" name="id" value="' . $id . '">
                        </form>';
                    } else {
                        echo 'User not found.';
                    }
                }
            ?>
        </div>  
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
