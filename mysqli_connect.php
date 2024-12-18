<?php
$dbcon = @mysqli_connect('localhost', 'root', '', 'members_arias')
OR die('Could not connect to MySQL Server: ' . mysqli_connect_error());

mysqli_set_charset($dbcon, 'utf8');
?>
