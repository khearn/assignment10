<?php
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
$dbUserName = 'khearn_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = 'KHEARN_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

$yourURL = $domain . $phpSelf;

$task = "";
$details = "";
$toDoDate = "";
$category = "";

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


        $query = "INSERT INTO tblTasks "
                . "JOIN tblRelationship ON pmkTaskId=fnkTaskId "
                . "JOIN tblCategories ON pmkCategoryId=fnkCategoryId "
                . "(fldTask, fldDescription, fldToDoDate, fldCategory) "
                . "VALUES ('" . $task . "', '" . $details . "', '" . $toDoDate . "', '" . $category . "')";

        $data = array($task);
        $data[] = $details;
        $data[] = $toDoDate;
        $data[] = $category;

        $records = $thisDatabase->insert($query, $data);
    }
}
?>

<article>

    <?php
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) {
        print "<h1>Your Task has ";
        if (!$mailed) {
            print "not ";
        }
        print "been saved</h1>";

        if (!$mailed) {
            print "not ";
        }
        print "been saved</p>";
    } else {
        ?>

        <form action="/cs148/assignment10/register.php"
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

                <!--<label for="tel">Cell Phone
                    <input type="tel" name="tel" id="tel" required>
                </label>-->
            </fieldset>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Make A Task" tabindex="900" class="button">                    
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