<?php

require_once('../bin/myDatabase.php');
$dbUserName = 'mljoy_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'MLJOY_RANDOM_TASK';
/*
$dbUserName = 'khearn_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK'; 
*/
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

// Connect to server and select databse.
//mysql_connect($thisDatabase, $email, $password)or die("cannot connect");
//mysql_select_db($dbName)or die("cannot select DB");
/*
// username and password sent from form 
$myusername = $_GET['pmkUsername'];
$mypassword = $_GET['fldPassword'];




$sql = "SELECT pmkUsername, fldPassword, pmkEmail "
        . "FROM tblUsers "
        . "WHERE pmkUsername = " . $_SESSION['myusername'] . " "
        . " AND fldPassword = " . $_SESSION['mypassword'] . "";
$records = array($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($records);

// If result matched $myusername and $mypassword, table row must be 1 row
if ($count == 1) {

// Register $myusername, $mypassword and redirect to file "profile.php"
    session_register($myusername);
    session_register($mypassword);
    //header("location:profile.php");
} else {
    print "Wrong Username or Password";
}
*/

// username and password sent from form 
$myusername=$_POST['myusername']; 
$mypassword=$_POST['mypassword']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
//$encrypted_mypassword=sha1($mypassword);
//echo $encrypt_password; 
$sql="SELECT pmkUsername, fldPassword, pmkEmail ";
$sql .= "FROM tblUsers ";
$sql .= "WHERE pmkUsername='$myusername' ";
$sql .= "AND fldPassword='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword"); 
header("location:login_success.php");
} elseif(!$count==1){
print "Wrong Username or Password";
}
//ob_end_flush();
?>