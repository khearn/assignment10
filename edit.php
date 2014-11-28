<?php
/* the purpose of this page is to display a form to allow a poet and allow us
 * to add a new poet or update an existing poet
 *
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: November 20, 2014
 *
 */

include "top.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
$update = false;
//$task = "";
//$details = "";
//$toDoDate = "";
//$category = "";
//$taskId = "";

// SECTION: 1a.
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

if (isset($_GET["pmkTaskId"])) {
    $taskId = htmlentities($_GET["pmkTaskId"], ENT_QUOTES, "UTF-8");

    $query = 'SELECT fldTask, fldDescription, fldToDoDate ';
    $query .= 'FROM tblTasks WHERE pmkTaskId = ?';

    $results = $thisDatabase->select($query, array($taskId));

    $task = $results[0]["fldTask"];
    $details = $results[0]["fldDescription"];
    $toDoDate = $results[0]["fldToDoDate"];
} else {
    $taskId = -1;
}

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$taskERROR = false;
$toDoDateERROR = false;
$detailsERROR = false;
$categoryERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
$data = array();
$dataEntered = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2a Security
//
    /*    if (!securityCheck(true)) {
      $msg = "<p>Sorry you cannot access this page. ";
      $msg.= "Security breach detected and reported</p>";
      die($msg);
      }
     */
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2b Sanitize (clean) data
// remove any potential JavaScript or html code from users input on the
// form. Note it is best to follow the same order as declared in section 1c.
    $taskId = htmlentities($_POST["pmkTaskId"], ENT_QUOTES, "UTF-8");
    if ($taskId > 0) {
        $update = true;
    }
    // I am not putting the ID in the $data array at this time


    $task = htmlentities($_POST["txtTask"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $task;

    $details = htmlentities($_POST["txtDetails"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $details;

    $toDoDate = htmlentities($_POST["datepicker"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $toDoDate;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2c Validation
//
    if ($task == "") {
        $errorMsg[] = "Please enter a task you would like to save";
        $taskERROR = true;
    } elseif (!verifyAlphaNum($task)) {
        $errorMsg[] = "Your task appears to have extra character.";
        $taskERROR = true;
    }
    if ($details == "") {
        $errorMsg[] = "Please enter the details of your task";
        $detailsERROR = true;
    } elseif (!verifyAlphaNum($details)) {
        $errorMsg[] = "There appears to be extra characters in your details.";
        $detailsERROR = true;
    }
    if ($toDoDate == "") {
        $errorMsg[] = "Please enter the to do date for this task";
        $toDoDateERROR = true;
    }// should check to make sure its the correct date format
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2d Process Form - Passed Validation
//
// Process for when the form passes validation (the errorMsg array is empty)
//
    if (!$errorMsg) {
        if ($debug) {
            print "<p>Form is valid</p>";
        }

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2e Save Data
//

        $dataEntered = false;

        if ($update) {
            $query = 'UPDATE tblTasks SET ';
        } 
        //else {
        //    $query = 'INSERT INTO tblTasks SET ';
        //}

        $query .= 'fldTask = "' . $task . '", ';
        $query .= 'fldDescription = "' . $details . '", ';
        $query .= 'fldToDoDate = "' . $date . '" ';

        if ($update) {
            $query .= 'WHERE pmkTaskId = ?';
            $data[] = $taskId;

            $results = $thisDatabase->update($query, $data);
        } 
        //else {
        //    $results = $thisDatabase->insert($query, $data);
        //}

        // all sql statements are done so lets commit to our changes
        /*
          $server = "webdb.uvm.edu";
          $user =  "mljoy_admin";
          $myPassword = "TwV28wTWrWZz95vk";
          $dataBase = "MLJOY_RANDOM_TASK";
         */
        $server = "webdb.uvm.edu";
        $user = "khearn_admin";
        $myPassword = "NetWt24oz";
        $dataBase = "KHEARN_RANDOM_TASK";

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
        }
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
if ($dataEntered) { // closing of if marked with: end body submit
    print "<h1>Record Saved</h1> ";
    print "<p>Return to your <a href='profile.php'>Task List</a></p>";
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
            <fieldset class="wrapper">
                <legend>Edit Tasks</legend>

                <input type="hidden" id="pmkTaskId" name="pmkTaskId"
                       value="<?php print $taskId; ?>"
                       >

                <label for="txtTask">Task
                    <input type="text" id="txtTask" name="txtTask" required
                           value="<?php print $task ?>"
                           tabindex="100" maxlength="45" placeholder="here you should write the task you have to do"
    <?php if ($taskERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>
                <label for="txtDetails">Details/Description (optional)
                    <input type="text" id="txtDetails" name="txtDetails"
                           value="<?php print $details ?>"
                           tabindex="200" maxlength="45" placeholder="here you can write the details of your task. For example, if the task is go grocery shopping, you could write out your shopping list here!"
    <?php if ($detailsERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>
                <label for="datepicker">Date:
                    <input type="text" id="datepicker" name="datepicker" value="<?php print $toDoDate; ?>">
                </label>

                <!--<label for="tel">Cell Phone
                    <input type="tel" name="tel" id="tel" required>
                </label>-->
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Edit A Task" tabindex="900" class="button">
            </fieldset> <!-- ends buttons -->
        </form>
    <?php
} // end body submit
?>


    <?php
    include "footer.php";
    if ($debug)
        print "<p>END OF PROCESSING</p>";
    ?>
</article>
</body>
</html>