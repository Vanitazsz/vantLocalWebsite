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
    <title>Search Users - Website ni Lhanzy</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('admin-nav.php'); ?>

<div id="container">
    <h2><center>Search for Users</center></h2>
    
    <form action="searchUS.php" method="post">
        <div class="form-group">
            <p><label for="search">Search by First Name, Last Name, or Email:</label>
            <input type="text" id="search" name="search" size="30" maxlength="50" 
                value="<?php if (isset($_POST['search'])) echo $_POST['search']; ?>">
            </p>
        </div>
        
        <p><input type="submit" value="Search"></p>
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        // Include the database connection
        require('mysqli_connect.php');
        
        // Get the search query
        $search_query = mysqli_real_escape_string($dbcon, trim($_POST['search']));
        
        // Query to search users by first name, last name, or email
        $q = "SELECT user_id, fname, lname, email FROM users 
              WHERE fname LIKE '%$search_query%' OR lname LIKE '%$search_query%' OR email LIKE '%$search_query%'";
        
        $result = @mysqli_query($dbcon, $q);
        
        // Check if any users are found
        if (mysqli_num_rows($result) > 0) {
            echo '<h3>Search Results:</h3>';
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>';
            
            // Display the users found
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . $row['user_id'] . '</td>';
                echo '<td>' . $row['fname'] . '</td>';
                echo '<td>' . $row['lname'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="error">No users found matching your search.</p>';
        }

        // Free the result and close the connection
        mysqli_free_result($result);
        mysqli_close($dbcon);
    }
    ?>
</div>

<?php include('footer.php'); ?>
</body>
</html>
