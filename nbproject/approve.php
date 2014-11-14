<!DOCTYPE html>
<html lang="en">
<head>
<title>MALLORY MADE A WEBSITE ALMOST</title>
<meta charset="utf-8">
<meta name="author" content="Mallory Joy">
<meta name="description" content="What are you doing with your life? NOT searching for your approval.">
    
<link rel="stylesheet"
	  href="Assignment1StyleSheet.css"
      media="screen">
      
</head>

<?php
//build variable
	$check = htmlentities($_GET['q'], ENT_QUOTES, "UTF-8"); 
	
//connect to database
require_once('../bin/myDatabase.php');

    $dbUserName = get_current_user() . '_writer';
    $whichPass = "w"; //flag for which one to use.
    $dbName = strtoupper(get_current_user()) . '_CRUD';
	$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
	
//build query

$query = "SELECT fldApproveCheck FROM tblUser WHERE fldApproveCheck = '$check'";

//execute query
$results = $thisDatabase->select($query);



foreach ($results as $row) {
        if ($firstTime) {
            
            $keys = array_keys($row);
            foreach ($keys as $key) {
                if (!is_int($key)) {
                
                }
            }
            
            $firstTime = false;
        }
        
        /* display the data, the array is both associative and index so we are
         *  skipping the index otherwise records are doubled up */
        
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                
            }
        }
       
    }



if ($results != "") {

$query = "UPDATE tblUser SET fldApproveCheck = '1' WHERE fldApprove = '$check' ";
$records = $thisDatabase->insert($query);

print "<p> Admin has approved the account.";

$query = "SELECT fldEmail FROM tblUser WHERE fldApprove = '$check' ";

$results = $thisDatabase->select($query);



foreach ($results as $row) {
        if ($firstTime) {
            
            $keys = array_keys($row);
            foreach ($keys as $key) {
                if (!is_int($key)) {
                
                }
            }
            
            $firstTime = false;
        }
        
        /* display the data, the array is both associative and index so we are
         *  skipping the index otherwise records are doubled up */
        
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                
            }
        }
       
    }
    

$message = "An administrator has verified your account. ";

$subject = "User Approval";
$to = "$value";
$headers = " ";
mail($to, $subject, $message, $headers);
}
else {
print "<p> Oh no! We couldn't find you on the server. Please call us for assistance. </p>";
}

include "footer.php"; ?>

</body>
</html>
	