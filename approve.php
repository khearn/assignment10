<?php
/* the purpose of this page is to accept the hashed date joined and primary key  
 * as passed into this page in the GET format.
 * 
 * I retrieve the date joined from the table for this person and verify that 
 * they are the same. After which i update the confirmed field and acknowlege 
 * to the user they were successful. Then i send an email to the system admin 
 * to approve their membership 
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: October 17, 2014
 * 
 */ 
include "top.php";

print '<article id="main">';


//build variable
	$check = htmlentities($_GET['q'], ENT_QUOTES, "UTF-8"); 
	
//connect to database
require_once('../bin/myDatabase.php');

    /*
$dbUserName = 'mljoy_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'MLJOY_RANDOM_TASK';
 */
$dbUserName = 'khearn_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK';

	$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
	
//build query

$query = "SELECT fldApproveCheck FROM tblUsers WHERE fldApproveCheck = '$check'";

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

$query = "UPDATE tblUsers SET fldApproveCheck = '1' WHERE fldApprove = '$check' ";
$records = $thisDatabase->insert($query);

print "<p> Admin has approved the account.";

$query = "SELECT fldEmail FROM tblUsers WHERE fldApprove = '$check' ";

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
    

//$message = "An administrator has verified your account. Copy this address into your address bar to get started! https://mljoy.w3.uvm.edu/cs148/assignment10/manage_task.php";
$message = "An administrator has verified your account. Copy this address into your address bar to get started! https://khearn.w3.uvm.edu/cs148/assignment10/manage_task.php";

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
	