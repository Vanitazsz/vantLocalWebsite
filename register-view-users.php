<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website ni Lhanzy</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('header.php'); ?>
<?php include('admin-nav.php'); ?>
    <div id="container">
        <div id="content">
            <h2>Registered Users</h2>
            <p>
                <center>
                    <?php
                        require("mysqli_connect.php");
                        $q = "SELECT CONCAT(lname, ', ', fname) as fullname, email, DATE_FORMAT(registration_date, '%M %D %Y') as regdat, user_id from users ORDER BY user_id ASC";
                        $result = @mysqli_query($dbcon, $q); 
                        if ($result) {
                            echo '<table><tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                                <th>Actions</th>
                            </tr>';
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo '<tr>
                                    <td>' . $row['fullname'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['regdat'] . '</td>
                                    <td>
                                        <a href="delete-user.php?id=' . $row['user_id'] . '"><button class="delete-btn"><i class="fas fa-trash-alt"></i></button></a>
                                        <a href="edit-user.php?id=' . $row['user_id'] . '"><button class="edit-btn"><i class="fas fa-edit"></i></button></a>
                                    </td>
                                </tr>';
                            }
                            echo '</table>';
                        } else {
                            echo '<p class="error">The current registered users could not be retrieved. Contact the system administrator.</p>';
                        }
                        mysqli_close($dbcon);
                    ?>
                </center>
            </p>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
