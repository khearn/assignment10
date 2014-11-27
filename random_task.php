<?php
include "include/top.php";
//include ('login.php');
include "include/header.php";
include "include/nav.php";
?>

<?php 

$randomTask = "";
$comments = "";

$randomTaskERROR = false;
$commentsERROR = false;

$randomTask = htmlentities($_POST["txtRandomTask"],ENT_QUOTES,"UTF-8");
$dataRecord[]=$randomTask;
$comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
$dataRecord[] = $comments; 

if($randomTask==""){
   $errorMsg[]="Please enter a Random Task";
   $randomTaskERROR = true;
}elseif(!verifyAlphaNum($randomTask)){
   $errorMsg[]="Your Random Task appears to have extra character.";
   $randomTaskERROR = true;
}   

$query = "INSERT INTO tblRandomTask (pmkRandomTaskId, fldRandomTask, fldDescription) VALUES ('" . $taskId . "', '" . $randomTask . "', '" . $comments . "')";


/*
 * 
CREATE TABLE IF NOT EXISTS tblRandomTask (
    pmkRandomTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldRandomTask varchar(500) NOT NULL,
    fldDescription TEXT(65535) NULL,
    PRIMARY KEY (pmkRandomTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblTaskship (
    fnkEmail varchar(320) NOT NULL,
    fnkRandomTaskId int(11) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 * 
 */

?>


<article>
    <h2>Random Task</h2>
    <aside>
        <!-- Random Task Display -->
    <?php
    print "<ul>";

        $firstTime = true;

        /* since it is associative array display the field names */
        foreach ($results as $row) {
            if ($firstTime) {
                print "<li>$randomTask";
                print "<ul><li>$comments</li></ul>";
                print "</li>";
                print "<thead><tr>";
            }
        }
    print "</ul>";
                
/*
                $keys = array_keys($row);
                foreach ($keys as $key) {
                    if (!is_int($key)) {
                        print "<th>" . $key . "</th>";
                    }
                }
                print "</tr>";
                $firstTime = false;
            }
*/
            /* display the data, the array is both associative and index so we are
             *  skipping the index otherwise records are doubled up */
/*
            print "<tr>";
            foreach ($row as $field => $value) {
                if (!is_int($field)) {
                    print "<td>" . $value . "</td>";
                }
            }
            print "</tr>";
        }
        print "</table>";
 */
        ?>
        
        
    <form action="/cs148/assignment10/random_task.php"
              method="post"
              id="frmRegister">
        <fieldset>
            <label for="txtRandomTask" class="required">Random Task
                <input type="text" id="txtRandomTask" name="txtRandomTask"
                       value="<?php print $randomTask; ?>"
                       tabindex="100" maxlength="45" placeholder="Enter a Random Task"
                       <?php if ($randomTaskERROR) print 'class="mistake"'; ?>
                       onfocus="this.select()"
                       autofocus>
            </label>
            <label for="txtComments" class="required">Comments</label>
            <textarea id="txtComments" 
                      name="txtComments" 
                      tabindex="200"
                      <?php if ($commentsERROR) print 'class="mistake"'; ?>
                      onfocus="this.select()" 
                      style="width: 25em; height: 4em;" ><?php print $comments; ?></textarea>
        
                    <input type="submit" id="btnSubmit" name="btnSubmit" value="Who Throws a Shoe!?" tabindex="900" class="button">
                </fieldset>
    </form>
    </aside>
</article>

<?php
include ('include/footer.php');
?>


</body>
</html>