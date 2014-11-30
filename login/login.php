<?php
include "include/top.php";
include "include/header.php";
include "include/nav.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.
$debug = false;
if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</p>";

require_once('../bin/myDatabase.php');
$dbUserName = 'mljoy_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'MLJOY_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$yourURL = $domain . $phpSelf;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form
$email="";
$password="";
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$emailERROR = false;
$passwordERROR = false;
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();
//$mailed = false; // have we mailed the information to the user?
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
//
if (isset($_POST["btnSubmit"])) {
        
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");

	$query = "SELECT pmkEmail, fldPassword FROM tblUser";

	$server = "webdb.uvm.edu";
	$user =  "mljoy_admin";
	$myPassword = "TwV28wTWrWZz95vk";
	$dataBase = "MLJOY_RANDOM_TASK";

	
	$connect = mysqli_connect($server, $user, $myPassword, $dataBase);
	
	if($connect->connect_error) {
	die("CONNECTION FAILED: " . $connect->connect_error);
	}
	
	else{
	//echo 'This connected';
	}
	
	if($connect->query($query) === TRUE) {
//	echo 'This worked';
	}
	
	else {
//	echo 'Ya done goofed, eh?';
	}
    
//    echo $query;
   if ($debug) {
                print $query;
            }


            if ($debug) {
                print $query;
            }


           /* $records = $thisDatabase->db->insert($query); */

            if ($debug) {
                print "<div>" . count($records) . " records created.</div>";
                print_r($data);
            }
            $firstTime = true;
/*
            // all sql statements are done so lets commit to our changes
            $dataEntered = $thisDatabase->db->commit();
            $dataEntered = true;
            if ($debug)
                print "<p>transaction complete ";
        } catch (PDOException $e) {
            $thisDatabase->db->rollback();
            if ($debug)
                print "Error!: " . $e->getMessage() . "</br>";
            $errorMsg[] = "There was a problem with accpeting your data please contact us directly.";
        }
        // If the transaction was successful, give success message
        if ($dataEntered) {
            if ($debug)
                print "<p>Success</p> ";
        } */
        /* since it is associative array display the field names */
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ 
        //
 // SECTION: 2a Security
        // 
        if (!securityCheck(true)) {
            $msg = "<p>Sorry you cannot access this page. ";
            $msg.= "Security breach detected and reported</p>";
            die($msg);
        }
        
        
    // SECTION: 2b Sanitize (clean) data 
        // remove any potential JavaScript or html code from users input on the
        // form. Note it is best to follow the same order as declared in section 1c.
        $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
        $dataRecord[] = $email;
        
        
        $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $password;
       
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
    // SECTION: 2c Validation
        //
    // Validation section. Check each value for possible errors, empty or
        // not what we expect. You will need an IF block for each element you will
        // check (see above section 1c and 1d). The if blocks should also be in the
        // order that the elements appear on your form so that the error messages
        // will be in the order they appear. errorMsg will be displayed on the form
        // see section 3b. The error flag ($emailERROR) will be used in section 3c.
        if ($email == "") {
            $errorMsg[] = "Please enter your email address";
            $emailERROR = true;
        } elseif (!verifyEmail($email)) {
            $errorMsg[] = "Your email address appears to be incorrect.";
            $emailERROR = true;
        } /*elseif ($sql_email) { 
            $errorMsg[] = "Sorry, an Account has already been made for this email address.";
            $emailERROR = true;
        } elseif (!$sql_email) { 
            $emailERROR = false;
        }*/
        if ($password == "") {
            $errorMsg[] = "Please enter a password";
            $passwordERROR = true;
        } elseif (!verifyAlphaNum($password)) {
            $errorMsg[] = "Your password appears to have extra character.";
            $passwordERROR = true;
        } 
        
       
        
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
    // SECTION: 2d Process Form - Passed Validation
        //
    // Process for when the form passes validation (the errorMsg array is empty)
        //
    
      
        if (!$errorMsg) {
            if ($debug)
                print "<p>Form is valid</p>"; 
            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
        //
        // SECTION: 2e Save Data
            //
        // This block saves the data to a CSV file.
            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
        // SECTION: 2f Create message
            //
        // build a message to display on the screen in section 3a and to mail
            // to the person filling out the form (section 2g).
            //?q means there will be a variable afterwards. 
//           $message = 'Welcome! Please click this link to confirm.';
            //$message .= " https://mljoy.w3.uvm.edu/cs148/assignment10/confirm.php?q=";
          //  $message .= " https://khearn.w3.uvm.edu/cs148/assignment10/confirm.php?q=";
            //$message .= $confirm;
            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
        // SECTION: 2g Mail to user
            //
        // Process for mailing a message which contains the forms data
            // the message was built in section 2f.
     //        $to = $email; // the person who filled out the form
       // $cc = "";
       // $bcc = "";
      //  $from = "Random Task Confirmation <noreply@yoursite.com>";
        // subject of mail should make sense to your form
       // $todaysDate = strftime("%x");
        //$subject = "Welcome to the Random Task: " . $todaysDate;
        //mail($to, $subject, $message, $headers);
       // } // end form is valid
    } //something else...?
}// ends if form was submitted. */
//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">
    <h2>Log In</h2>

<?php
//####################################
//
// SECTION 3a.
//
// 
// 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
	$handle = fopen("http://www.mljoy.w3.uvm.edu/assignment10/checklogin.php");
    //print "<h1> Congratulations! You should receive a confirmation email shortly. </h1>";
} else {
    //####################################
    //
        // SECTION 3b Error Messages
    //
        // display any error messages before we print out the form
    if ($errorMsg) {
        print '<div id="errors">';
        print "<ol>\n";
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        print "</ol>\n";
        print '</div>';
  }}  
    //####################################
    //
        // SECTION 3c html Form
    //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
      is defined in top.php
      NOTE the line:
      value="<?php print $email; ?>
      this makes the form sticky by displaying either the initial default value (line 35)
      or the value they typed in (line 84)
      NOTE this line:
      <?php if($emailERROR) print 'class="mistake"'; ?>
      this prints out a css class so that we can highlight the background etc. to
      make it stand out that a mistake happened here.
     */
    ?>

<!--       <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">

</form> -->


<form name="form1" method="post" action="checklogin.php">
    <fieldset>
        <label>Username<input name="myusername" type="text" id="myusername"></label>
        <label>Password<input name="mypassword" type="password" id="mypassword"></label>
        <input type="submit" name="Submit" value="Login">
    </fieldset>
</form>
