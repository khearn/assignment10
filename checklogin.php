<?php

require_once('../bin/myDatabase.php');
$dbUserName = 'khearn_admim';
$whichPass = "a"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

// Connect to server and select databse.
//mysql_connect($thisDatabase, $email, $password)or die("cannot connect");
//mysql_select_db($dbName)or die("cannot select DB");

// username and password sent from form 
$email = $_GET['pmkEmail'];
$password = $_GET['fldPassword'];

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);

$sql = "SELECT pmkEmail, fldPassword FROM tblUsers WHERE username='$email' and password='$password'";
$records = array($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($records);

// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

// Register $myusername, $mypassword and redirect to file "profile.php"
    session_register($email);
    session_register($password);
    header("location:profile.php");
} else {
    echo "Wrong Username or Password";
}
?>