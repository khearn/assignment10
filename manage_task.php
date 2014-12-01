<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);

include "include/top.php";
//session_start();
//include "session_start.php";
//include ('login.php');
include "include/header.php";
include "include/nav.php";
?>
<!-- Need to add email/account info once that is working -->
<?php
/*
  CREATE TABLE IF NOT EXISTS tblTasks (
  fnkEmail varchar(320) NOT NULL,
  pmkTaskId int(11) NOT NULL AUTO_INCREMENT,
  fldTask varchar(500) NOT NULL,
  fldDescription TEXT(65535) NULL,
  fldToDoDate DATE NOT NULL,
  PRIMARY KEY (fnkEmail, pmkTaskId)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS tblRelationship (
  fnkEmail varchar(320) NOT NULL,
  fnkCategoryId int(11) NOT NULL,
  fnkTaskId int(11) NOT NULL,
  PRIMARY KEY (fnkEmail, fnkCategoryId, fnkTaskId)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  CREATE TABLE IF NOT EXISTS tblCategories (
  pmkCategoryId int(11) NOT NULL AUTO_INCREMENT,
  fldCategory varchar(500) NOT NULL,
  PRIMARY KEY (pmkCategoryId)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 */


require_once('../bin/myDatabase.php');
$dbUserName = 'mljoy_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'MLJOY_RANDOM_TASK';

/* $dbUserName = 'khearn_writer';
  $whichPass = "w"; //flag for which one to use.
  $dbName = 'KHEARN_RANDOM_TASK'; 
*/
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

$yourURL = $domain . $phpSelf;

$task = "";
$details = "";
$toDoDate = "";
$category = "";
$taskId = "";


$taskERROR = false;
$toDoDateERROR = false;
$detailsERROR = false;
$categoryERROR = false;

$errorMsg = array();
$dataRecord = array();
$mailed = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
if (isset($_POST["btnSubmit"])) {


    $debug = false;
    if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
        $debug = true;
    }
    if ($debug)
        print "<p>DEBUG MODE IS ON</p>";


    if (!securityCheck(true)) {
        $msg = "<p>Sorry you cannot access this page. ";
        $msg.= "Security breach detected and reported</p>";
        die($msg);
    }

//sanitize
    $task = htmlentities($_POST["txtTask"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $task;
    $details = htmlentities($_POST["txtDetails"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $details;
    $toDoDate = htmlentities($_POST["datepicker"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $toDoDate;
    $category = htmlentities($_POST["lstCategory"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $category;

//validate
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
    } elseif (!verifyAlphaNum($toDoDate)) {
        $errorMsg[] = "The date you have imputed appear to be in the incorrect format.";
        $toDoDateERROR = true;
    }
    if ($category == "") {
        $errorMsg[] = "Please select a Category";
        $categoryERROR = true;
    } elseif (!verifyAlphaNum($category)) {
        $errorMsg[] = "There appears to be extra characters in your Category.";
        $categoryERROR = true;
    }

//Process Form - Passed Validation
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";
//M/D/Y --> Y-M-D

        $query = "START TRANSACTION";
        $query = "INSERT INTO tblTasks(fnkEmail, fldTask, fldDescription, fldToDoDate) "
                . "VALUES ('khearn@uvm.edu', '" . $task . "', '" . $details . "', '" . $toDoDate . "')";
        $query = "INSERT INTO tblRelationship(fnkEmail, fnkCategoryId, fnkTaskId) "
                . "VALUES ('" . $email . "', '" . $catId . "', '" . $taskId . "')";
        $query = "INSERT INTO tblCategories(pmkCategoryId, fldCategory) "
                . "VALUES ('" . $catId . "', '" . $category . "')";
        $query .= "COMMIT";

        $data = array($task);
        $data[] = $details;
        $data[] = $toDoDate;
        $data[] = $taskId;
        $data[] = $catId;
        $data[] = $category;
//        $data[] = $email;

        $records = $thisDatabase->insert($query, $data);

          $server = "webdb.uvm.edu";
          $user =  "mljoy_admin";
          $myPassword = "TwV28wTWrWZz95vk";
          $dataBase = "MLJOY_RANDOM_TASK"; 
/*
        $server = "webdb.uvm.edu";
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
    }
}
?>

<article>
    <h2>Create a Task</h2>


    <?php
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
        print "<h1>Record ";
        print "Saved</h1>";
        print "<aside>";
        print "<p>Return to your <a href='profile.php'>Task List</a></p>";
        print "</aside>";
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
        ?> 

        <form action="/cs148/assignment10/manage_task.php"
              method="post"
              id="frmRegister">
            <fieldset id="Make-a-Task">

                <label for="lstCategory">Category
                    <select id="lstCategory"
                            name="lstCategory"
                            tabindex="100" >
                                <?php
                                //creating list query
                                $query = "SELECT DISTINCT fldCategory ";
                                $query .= "FROM tblCategories ";
                                $query .= "ORDER BY fldCategory";

                                $list2 = $thisDatabase->select($query, $data);

                                foreach ($list2 as $row) {
                                    print "<option value = '" . $row["fldCategory"] . "'>" . $row["fldCategory"] . "</option>\n";
                                }
                                ?>
                    </select>
                </label>
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


                <input type="submit" id="btnSubmit" name="btnSubmit" value="Make A Task" tabindex="900" class="button">                    
            </fieldset>
        </form>

    </article>

    <?php
}
?>

<?php
include ('include/footer.php');
?>

</body>
</html>