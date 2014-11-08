<?php

require_once('../bin/myDatabase.php');
$dbUserName = 'khearn_reader';
$whichPass = "r"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

// Connect to server and select databse.
mysql_connect("$host", "$email", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$email = $_POST['txtEmail'];
$password = $_POST['pwdPassword'];

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);
$sql = "SELECT * FROM tblUsers WHERE username='$password' and password='$password'";
$result = mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

// Register $myusername, $mypassword and redirect to file "login_success.php"
    session_register("txtEmail");
    session_register("pwdPassword");
    header("location:login_success.php");
} else {
    echo "Wrong Username or Password";
}
?>