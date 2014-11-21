<?php
/*
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
$hash = $_GET['fldPassword'];




$sql = "SELECT pmkEmail, fldPassword FROM tblUsers WHERE pmkEmail = " . $_SESSION['myusername'] . " "
        . " AND fldPassword = " . $_SESSION['username'] . "";
$records = array($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($records);

// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

// Register $myusername, $mypassword and redirect to file "profile.php"
    session_register($email);
    session_register($hash);
    //header("location:profile.php");
} else {
    echo "Wrong Username or Password";
}
*/
?>


<?php

require_once('../bin/myDatabase.php');
$dbUserName = 'khearn_admim';
$whichPass = "a"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$encrypted_mypassword=sha1($mypassword);
echo $encrypt_password; 
$sql="SELECT * FROM tblUsers WHERE pmkUsername='$myusername' and fldPassword='$encrypted_mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:login_success.php");
}
else {
echo "Wrong Username or Password";
}
ob_end_flush();
?>