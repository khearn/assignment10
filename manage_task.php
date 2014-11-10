<?php
include "top.php";
//include ('login.php');
include "header.php";
include "nav.php";
?>

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


$task = "";
$details = "";

?>

<article>

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

                    <!--
                    <option value="HW">Home Work</option>
                    <option value="Chores">Chores</option>
                    <option value="Obligations" >Obligations</option>
                    <option value="Personal" >Personal</option>
                    <option value="Doctor" >Doctor</option>
                    <option value="" selected>Other</option>
                    -->

                </select>

            </label>

            <label for="txtTask">Task
                <input type="text" id="txtTask" name="txtTask"
                       value="<?php print $task ?>"
                       tabindex="100" maxlength="45" placeholder="here you should write the task you have to do"
                       <?php if ($taskERROR) print 'class="mistake"'; ?>
                       onfocus="this.select()"
                       >
            </label>

            <label for="txtBox">Details/Description (optional)
                <input type="text" id="txtDetails" name="txtDetails"
                       value="<?php print $details ?>"
                       tabindex="100" maxlength="45" placeholder="here you can write the details of your task. For example, if the task is go grocery shopping, you could write out your shopping list here!"
                       <?php if ($detailsERROR) print 'class="mistake"'; ?>
                       onfocus="this.select()"
                       >
            </label>



        </fieldset>
    </form>

</article>

<?php
include ('footer.php');
?>


</body>
</html>