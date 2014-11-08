<?php
include "top.php";
include "header.php";
include "nav.php";
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
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_RANDOM_TASK';
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
$email = "";
$password = "";
$fname = "";
$lname = "";
$date = date("Y-m-d H:i:s");

$confirm = "";
$headers = "";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$emailERROR = false;
$passwordERROR = false;
$fnameERROR = false;
$lnameERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
// array used to hold form values that will be written to a CSV file
$dataRecord = array();
$mailed = false; // have we mailed the information to the user?
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
//
if (isset($_POST["btnSubmit"])) {
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;

    $fname = htmlentities($_POST["txtfname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $fname;

    $lname = htmlentities($_POST["txtlname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lname;


    

//creates jumbled up thing to equal email
    $confirm = sha1($email);
    $approved = sha1($confirm);



// add gender later
    $query = "INSERT INTO tblUsers(pmkEmail, fldPassword, fldLastName, fldDate, fldHash) ";
    $query = "VALUES ('" . $email . "', '" . $password . "' , '" . $fname . "', '" . $lname . "', '" . $date . "', '" . $confirm . "')";


    if ($debug) {
        print $query;
    }



// go ahead and add the operation
//add each peice of data here!
    $data = array($email);
    $data[] = $password;
    $data[] = $fname;
    $data[] = $lname;
    $data[] = $confirm;


    $records = $thisDatabase->insert($query);
    if ($debug) {
        print "<div>" . count($records) . " records created.</div>";
        print_r($data);
    }
    $firstTime = true;
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

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;

    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;

    $fname = htmlentities($_POST["txtfname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $fname;

    $lname = htmlentities($_POST["txtlname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lname;
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
//validate
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    }

    if ($password == "") {
        $errorMsg[] = "Please enter a password";
        $passwordERROR = true;
    } elseif (!verifyAlphaNum($password)) {
        $errorMsg[] = "Your password appears to have extra character.";
        $passwordERROR = true;
    }

    if ($fname == "") {
        $errorMsg[] = "Please enter your first name";
        $fnameERROR = true;
    } elseif (!verifyAlphaNum($fname)) {
        $errorMsg[] = "Your first name appears to have extra character.";
        $fnameERROR = true;
    }

    if ($lname == "") {
        $errorMsg[] = "Please enter your last name";
        $lnameERROR = true;
    } elseif (!verifyAlphaNum($lname)) {
        $errorMsg[] = "Your last name appears to have extra character.";
        $lnameERROR = true;
    }

    //Not sure if this will work as is. may need to redo/delete
    // Check for duplicate e-mail address
    /*
      if ($email != '') {
      $qry = "SELECT * FROM members WHERE pmkEmail='$email'";
      $result = array($qry) or die('error' . mysql_error());
      if ($result) {
      if (mysql_num_rows($result) > 0) {
      $errorMsg[] = 'E-mail address already registered';
      $emailERROR = true;
      }
      @mysql_free_result($result);
      } else {
      die("Query Failed");
      }
      }

     */
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
        $message = 'Welcome! Please click this link to confirm.';
        $message .= " https://mljoy.w3.uvm.edu/cs148/assignment6.0/confirm.php?q=";
        $message .= $confirm;

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "";
        $from = "Random Task Registration Confirmation <noreply@yoursite.com>";
        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Welcome to Random Task: " . $todaysDate;
        mail($to, $subject, $message, $headers);
    } // end form is valid
} // ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">

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
        print "<h1> Congratulations! You should receive a confirmation email shortly. </h1>";
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
        }
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

        <form action="/cs148/assignment10/register.php"
              method="post"
              id="frmRegister">
            <fieldset class="register">
                <legend>Sign Up!</legend>

                <label for="txtfname">First Name
                    <input type="text" id="txtfname" name="txtfname"
                           value="<?php print $fname ?>"
                           tabindex="100" maxlength="45" placeholder="Please enter your First Name"
                           <?php if ($fnameERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtlname">Last Name
                    <input type="text" id="txtlname" name="txtlname"
                           value="<?php print $lname ?>"
                           tabindex="200" maxlength="45" placeholder="Please enter your Last Name"
                           <?php if ($lnameERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtEmail">Email
                    <input type="text" id="txtEmail" name="txtEmail"
                           value="<?php print $email ?>"
                           tabindex="300" maxlength="45" placeholder="Please enter a valid Email Address"
                           <?php if ($emailERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtPassword">Password
                    <input type="password" id="pwdPassword" name="pwdPassword"
                           value="<?php print $password ?>"
                           tabindex="400" maxlength="45" placeholder="Please enter a valid Email Address"
                           <?php if ($passwordERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>

                <fieldset class="radio">
                    <legend>Gender:</legend>
                    <label for="radFem">
                        <input type="radio" 
                               id="radFem" 
                               name="radGender" 
                               value="F" 
                               >Female
                    </label>
                    <label for="radMale">
                        <input type="radio" 
                               id="radMale" 
                               name="radGender" 
                               value="M">Male
                    </label>
                </fieldset>
                <!--
                                <fieldset class="checkbox">
                                    <legend>Please check all that apply to you:</legend>
                                    <label for="chkParent">
                                        <input type="checkbox" 
                                               id="chkParent" 
                                               name="chkParent" 
                                               value="2">Parent
                                    </label>
                                    <label for="chkStudent">
                                        <input type="checkbox" 
                                               id="chkStudent" 
                                               name="chkStudent" 
                                               value="3">Student
                                    </label>
                                    <label for="chkEmployed">
                                        <input type="checkbox" 
                                               id="chkEmployed" 
                                               name="chkEmployed" 
                                               value="4">Employed
                                    </label>
                                    <label for="chkPet">
                                        <input type="checkbox" 
                                               id="chkPet" 
                                               name="chkPet" 
                                               value="5">Pet Owner
                                    </label>
                                    <label for="chkMarried">
                                        <input type="checkbox" 
                                               id="chkMarried" 
                                               name="chkMarried" 
                                               value="2">Married
                                    </label>
                -->
                <!--
                <label for="chkProfession">
                    <input type="checkbox" 
                           id="chkProfession" 
                           name="chkProfession" 
                           value="3">Profession: 
                                <input type="text" name="profession"
                                       value="<?php //print $profession     ?>"
                                       tabindex="500" maxlength="45" placeholder="Please enter your job title"
                <?php //if ($professionERROR) print 'class="mistake"';   ?>
                                       onfocus="this.select()"
                                >
                                       
                </label>
                -->
            </fieldset>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Sign Up" tabindex="900" class="button">

            </fieldset>

        </form>

        <?php
    } // end body submit
    ?>

</article>

<?php include "footer.php"; ?>

</body>
</html>