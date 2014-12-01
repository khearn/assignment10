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

/* $dbUserName = 'khearn_writer';
  $whichPass = "w"; //flag for which one to use.
  $dbName = 'KHEARN_RANDOM_TASK'; 
*/
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
$username = "";
//$password = "";
$password = "";
$fname = "";
$lname = "";
$date = date("Y-m-d-H-i-s");
$hash = "";
$confirm = "";
$headers = "";
//$pic = "";
$gender = "Female";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$emailERROR = false;
$usernameERROR = false;
$passwordERROR = false;
$fnameERROR = false;
$lnameERROR = false;
$dateERROR = false;
$genderERROR = false;
//$picError = false;
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
    //if (isset($_FILES['image']) && $_FILES['fileToUpload']['size'] > 0) {


    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $username = htmlentities($_POST["txtUsername"], ENT_QUOTES, "UTF-8");
    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $fname = htmlentities($_POST["txtfname"], ENT_QUOTES, "UTF-8");
    $lname = htmlentities($_POST["txtlname"], ENT_QUOTES, "UTF-8");
    $confirm = sha1($email);
    //$hash = sha1($password);
    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    //$pic = file_get_contents($_FILES['fileToUpload']['name']);
    //$approved = sha1($confirm);
    // add gender later
    // 
    // Read the file
    /*
      $fp = fopen($pic, 'r');
      $data = fread($fp, filesize($pic));
      $data = addslashes($data);
      fclose($fp);
     */


    //without picture.
    $query = "INSERT INTO tblUsers(pmkEmail, pmkUsername, fldPassword, fldFirstName, fldLastName, fldDate, fldGender, fldHash) "
            . "VALUES ('" . $email . "', '" . $username . "', '" . $password . "', '" . $fname . "', '" . $lname . "', '" . $date . "', '" . $gender . "', '" . $hash . "')";

    //With Picture
//        $query = "INSERT INTO tblPicture(fnkUsername, fldPicture) VALUES ('" . $username . "', '" . $pic . "') ";

    
      $server = "webdb.uvm.edu";
      $user =  "mljoy_admin";
      $myPassword = "TwV28wTWrWZz95vk";
      $dataBase = "MLJOY_RANDOM_TASK"; 

/*    $server = "webdb.uvm.edu";
    $user = "khearn_admin";
    $myPassword = "NetWt24oz";
    $dataBase = "KHEARN_RANDOM_TASK";*/

    $connect = mysqli_connect($server, $user, $myPassword, $dataBase);

    if ($connect->connect_error) {
        die("CONNECTION FAILED: " . $connect->connect_error);
    } else {
        //echo 'This connected';
    }

    if ($connect->query($query) === TRUE) {
//	echo 'This worked';
    } else {
//	echo 'Ya done goofed, eh?';
//$fp = fopen($pic, 'r');
//$data = fread($fp, filesize($pic));
//$data = addslashes($data);
//fclose($fp);


        echo 'Ya done goofed, eh?';
    }

//    echo $query;


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    // check if user or email address already exists
    /*
      $query = "SELECT pmkUsername FROM tblUsers WHERE pmkUsername = '" . $username . "' ";
      $query = "SELECT pmkEmail FROM tblUsers WHERE pmkEmail = '" . $email . "' ";
      if ($query) {
      print "Sorry, that username is already taken.";
      } if ($query) {
      print "Sorry, an Account has already been made for this email address.";
      }
      else {
     */

    /*  $dataEntered = false;
      try { */
    //*     $thisDatabase->db->prepare($query);  /*THIS IS THE LINE YOU NEED TO FIX */

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

    $username = htmlentities($_POST["txtUsername"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $username;
    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;
    $fname = htmlentities($_POST["txtfname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $fname;
    $lname = htmlentities($_POST["txtlname"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lname;
    $gender = htmlentities($_POST["radGender"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $gender;
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
    } /* elseif ($sql_email) { 
      $errorMsg[] = "Sorry, an Account has already been made for this email address.";
      $emailERROR = true;
      } elseif (!$sql_email) {
      $emailERROR = false;
      } */
    if ($password == "") {
        $errorMsg[] = "Please enter a password";
        $passwordERROR = true;
    } elseif (!verifyAlphaNum($password)) {
        $errorMsg[] = "Your password appears to have extra character.";
        $passwordERROR = true;
    }

    if ($username == "") {
        $errorMsg[] = "Please enter a username";
        $usernameERROR = true;
    } elseif (!verifyAlphaNum($username)) {
        $errorMsg[] = "Your password appears to have extra character.";
        $usernameERROR = true;
    }/* elseif ($sql_user) {
      $errorMsg[] = "Sorry, that username is already taken.";
      $usernameERROR = true;
      } elseif (!$sql_user) {
      $usernameERROR = false;
      } */
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
        $message = 'Welcome! Please click this link to confirm.';
        $message .= " https://mljoy.w3.uvm.edu/cs148/assignment10/confirm.php?q=";
        //$message .= " https://khearn.w3.uvm.edu/cs148/assignment10/confirm.php?q=";
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
        $from = "Random Task Confirmation <noreply@yoursite.com>";
        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");
        $subject = "Welcome to the Random Task: " . $todaysDate;
        mail($to, $subject, $message, $headers);
        //} // end if pic is submit
    } //something else...?
}// ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">
    <h2>Sign Up</h2>

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
        print "<h1>Congratulations! You should receive a confirmation email shortly.</h1>";
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

        <form action="<?php print $phpSelf; ?>"

              method="post"
              id="frmRegister">
            <!--enctype="multipart/form-data"-->
            <fieldset class="register">
                <legend>Sign Up!</legend>

                <label for="txtfname">First Name
                    <input type="text" id="txtfname" name="txtfname"
                           value="<?php print $fname; ?>"
                           tabindex="100" maxlength="45" placeholder="Please enter your First Name"
                           <?php
                           if ($fnameERROR) {
                               print 'class="mistake"';
                           }
                           ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtlname">Last Name
                    <input type="text" id="txtlname" name="txtlname"
                           value="<?php print $lname; ?>"
                           tabindex="200" maxlength="45" placeholder="Please enter your Last Name"
                           <?php
                           if ($lnameERROR) {
                               print 'class="mistake"';
                           }
                           ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtEmail">Email
                    <input type="text" id="txtEmail" name="txtEmail"
                           value="<?php print $email; ?>"
                           tabindex="300" maxlength="45" placeholder="Please enter a valid Email Address"
                           <?php
                           if ($emailERROR) {
                               print 'class="mistake"';
                           }
                           ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="txtUsername">Username
                    <input type="text" id="txtEmail" name="txtUsername"
                           value="<?php print $username; ?>"
                           tabindex="350" maxlength="45" placeholder="Please enter a Username"
                           <?php
                           if ($usernameERROR) {
                               print 'class="mistake"';
                           }
                           ?>
                           onfocus="this.select()"
                           >
                </label>

                <label for="pwdPassword">Password
                    <input type="password" id="pwdPassword" name="pwdPassword"
                           value="<?php print $password; ?>"
                           tabindex="400" maxlength="45" placeholder="Please enter a valid password"
                           <?php
                           if ($passwordERROR) {
                               print 'class="mistake"';
                           }
                           ?>
                           onfocus="this.select()"
                           >
                </label> 

                <fieldset class="radio">
                    <legend>What is your gender?</legend>
                    <label><input type="radio" 
                                  id="radGenderMale" 
                                  name="radGender" 
                                  value="Male"
                                  <?php if ($gender == "Male");  ?>
                                  tabindex="330">Male</label>
                    <label><input type="radio" 
                                  id="radGenderFemale" 
                                  name="radGender" 
                                  value="Female"
                                  <?php if ($gender == "Female");  ?>
                                  tabindex="340">Female</label>
                    <label><input type="radio" 
                                  id="radGenderOther" 
                                  name="radGender" 
                                  value="Other"
                                  <?php if ($gender == "Other");  ?>
                                  tabindex="340">Other</label>
                </fieldset>

                <!--
                <input name="MAX_FILE_SIZE" value="102400" type="hidden">
                <label for="imgProfilePic">Profile Picture

                    <label for="imgProfilePic">Profile Picture

                        <input type="file" id="fileToUpload" name="fileToUpload"
                               accept="image/gif, image/jpeg, image/png, image/jpg"
                               tabindex="450" 
                               >
                    </label>
                    -->
                    <?php
                    /*
                      check if a file was submitted
                      if (!isset($_FILES['userfile'])) {
                      echo '<p>Please select a file</p>';
                      } else {
                      try {
                      upload();
                      //give praise and thanks to the php gods
                      echo '<p>Thank you for submitting</p>';
                      } catch (Exception $e) {
                      echo '<h4>' . $e->getMessage() . '</h4>';
                      }
                      }
                     */
                    ?>

                    <?php
                    /**
                     * the upload function
                     * @access public
                     * @return void

                      function upload(){
                      check if a file was uploaded
                      if(is_uploaded_file($_FILES['userfile']['tmp_name']) && getimagesize($_FILES['userfile']['tmp_name']) != false) {
                      //  get the image info.
                      $size = getimagesize($_FILES['userfile']['tmp_name']);
                      // assign our variables
                      $type = $size['mime'];
                      $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');
                      $size = $size[3];
                      $name = $_FILES['userfile']['name'];
                      $maxsize = 99999999;


                      //  check the file is less than the maximum file size
                      if($_FILES['userfile']['size'] < $maxsize ) {
                      // connect to db
                      $dbh = new PDO("mysql:host=localhost;dbname=testblob", 'username', 'password');

                      // set the error mode
                      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                      // our sql query
                      $stmt = $dbh->prepare("INSERT INTO testblob (image_type ,image, image_size, image_name) VALUES (? ,?, ?, ?)");

                      // bind the params
                      $stmt->bindParam(1, $type);
                      $stmt->bindParam(2, $imgfp, PDO::PARAM_LOB);
                      $stmt->bindParam(3, $size);
                      $stmt->bindParam(4, $name);

                      // execute the query
                      $stmt->execute();
                      } else {
                      // throw an exception is image is not of type
                      throw new Exception("File Size Error");
                      }
                      } else {
                      // if the file is not less than the maximum allowed, print an error
                      throw new Exception("Unsupported Image Format!");
                      }
                      }
                     * 
                     */
                    ?>


                    <fieldset class="buttons">
                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Sign Up" tabindex="900" class="button">
                    </fieldset> <!-- ends buttons -->

            </fieldset> <!-- Ends Wrapper -->
        </form>

        <?php
    } // end body submit
    ?>

</article>

<?php
include "include/footer.php";
if ($debug) {
    print "<p>END OF PROCESSING</p>";
}
?>

</body>
</html>