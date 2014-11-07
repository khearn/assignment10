<?php
include ('top.php');
include ('header.php');
include ('nav.php');
?>

<?php
//Save account creation info to database
//security
$yourURL = $domain . $phpSelf;

//variables
$email = "";
$password = "";
$fname = "";
$lname = "";
$myFavorite = 1;
$profession = "";

//form error flags
$emailERROR = false;
$passwordERROR = false;
$fnameERROR = false;
$lnameERROR = false;
$professionERROR = false;


// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
$dataRecord = array();

if (isset($_POST["btnSubmit"])) {
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
//
// SECTION: 2 Process for when the form is submitted
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



    //If pass validation
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";

        //Build Query
    //
        //
        //
        
        
    } // end form is valid
// execute query using a  prepared statement
}

//Display form
?>




<article>

    <?php
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
        print "<h1>A confirmation message has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent to your email</h1>";
        print "<p>A copy of this message has ";
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p>To: " . $email . "</p>";
        print "<p>Mail Message:</p>";
        print $message;
    } else {
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
                               value="2">Female
                    </label>
                    <label for="radMale">
                        <input type="radio" 
                               id="radMale" 
                               name="radGender" 
                               value="3">Male
                    </label>
                </fieldset>

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
                               value="6">Married
                    </label>
                    <label for="chkTravel">
                        <input type="checkbox" 
                               id="chkTravel" 
                               name="chkTravel" 
                               value="7">Frequent Traveler
                    </label>
                    
                    

                    <!--
                    <label for="chkProfession">
                        <input type="checkbox" 
                               id="chkProfession" 
                               name="chkProfession" 
                               value="3">Profession: 
                                    <input type="text" name="profession"
                                           value="<?php //print $profession ?>"
                                           tabindex="500" maxlength="45" placeholder="Please enter your job title"
                    <?php //if ($professionERROR) print 'class="mistake"'; ?>
                                           onfocus="this.select()"
                                    >
                                           
                    </label>
                    -->
                </fieldset>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Sign Up" tabindex="900" class="button">

            </fieldset>

        </form>

    </article>

    <?php
}
?>

<?php
include ('footer.php');
?>

</body>
</html>