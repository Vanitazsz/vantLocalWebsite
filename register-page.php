<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registerpage ng Website ni Lhanzy</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('nav.php'); ?>
    <div id="container">
        <div id="content">
            <?php
            // Include the MySQLi connection file
            include('mysqli_connect.php');

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $errors = array();

                // First Name validation
                if (empty($_POST['fname'])) {
                    $errors[] = 'Please enter your First Name.';
                } else {
                    $fn = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
                }

                // Last Name validation
                if (empty($_POST['lname'])) {
                    $errors[] = 'Please enter your Last Name.';
                } else {
                    $ln = mysqli_real_escape_string($dbcon, trim($_POST['lname']));
                }

                // Email validation
                if (empty($_POST['email'])) {
                    $errors[] = 'Please enter your Email Address.';
                } else {
                    $email = mysqli_real_escape_string($dbcon, trim($_POST['email']));
                }

                // Password validation
                if (empty($_POST['psword1'])) {
                    $errors[] = 'Please enter your Password.';
                } else {
                    if ($_POST['psword1'] != $_POST['psword2']) {
                        $errors[] = 'Password does not match.';
                    } else {
                        $p = mysqli_real_escape_string($dbcon, trim($_POST['psword1']));
                    }
                }

                // Query
                if (empty($errors)) {
                    // Hash the password before saving to the database
                    $hashed_password = password_hash($p, PASSWORD_DEFAULT);

                    // Insert into the database with hashed password
                    $query = "INSERT INTO users (fname, lname, email, psword, registration_date) 
                              VALUES ('$fn', '$ln', '$email', '$hashed_password', NOW())";

                    // Execute the query
                    $result = mysqli_query($dbcon, $query);

                    // Check if the query was successful
                    if ($result) {
                        echo '<h2>Thank you for registering!</h2>';
                        echo'
                            <a href="login.php" class="b-btn">Go Login</a>';
                    } else {
                        echo '<h2>Error!</h2><p class="error">Could not register due to a system error. Please try again later.</p>';
                        echo '<p>' . mysqli_error($dbcon) . '</p>'; // Debugging info
                    }

                    // Close the database connection
                    mysqli_close($dbcon);

                    // Stop script execution to prevent form from showing after successful registration
                    exit();
                } else {
                    echo '<h2>Error!</h2>';
                    echo '<p class="error">The following error(s) occurred:</p>';
                    foreach ($errors as $msg) {
                        echo "- $msg<br/>";
                    }
                    echo '<h4>Please try again.</h4><br/><br/>';
                }
            }
            ?>
            <h2><center>Register</center></h2>
            <form action="register-page.php" method="post">
                <div class="form-group">
                    <p><label class="label" for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
                    </p>
                </div>

                <div class="form-group">
                    <p><label class="label" for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
                    </p>
                </div>

                <div class="form-group">
                    <p><label class="label" for="email">Email Address:</label>
                    <input type="email" id="email" name="email" size="30" maxlength="50" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                    </p>
                </div>

                <div class="form-group">
                    <p><label class="label" for="psword1">Password:</label>
                    <input type="password" id="psword1" name="psword1" size="20" maxlength="40" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>">
                    </p>
                </div>

                <div class="form-group">
                    <p><label class="label" for="psword2">Re-Enter Password:</label>
                    <input type="password" id="psword2" name="psword2" size="20" maxlength="40" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>">
                    </p>
                </div>

                <p><input type="submit" id="submit" name="submit" value="Register"></p>
            </form>
        </div>			
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
