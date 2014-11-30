<?php
include "include/top.php";
//include ('login.php');
include "include/header.php";
include "include/nav.php";
?>

<article>
    <h2>Random Task</h2>
    <aside>
        <p>This is our Random Task page. below is a list of random tasks that you might want to try at some point in your life.  They were all posted by other users.  At the bottom of this page is a form where you can add random tasks.  If you ever do something really cool that you feel other people might want to try, post it here.</p>

        <?php
//Display All of the Random tasks

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
         
        /*$dbUserName = 'khearn_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = 'KHEARN_RANDOM_TASK'; */
        $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName); 



        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
        print '<body id="' . $path_parts['filename'] . '">';
        print "<article>";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// prepare the sql statement
        $orderBy = "ORDER BY pmkRandomTaskId ASC ";

        $query = "SELECT fldRandomTask, fldDescription ";
        $query .= "FROM tblRandomTask " . $orderBy;

        if ($debug)
            print "<p>sql" . $query;
        $randoms = $thisDatabase->select($query);

        if ($debug) {
            print "<pre>";
            print_r($randoms);
            print "</pre>";
        }

// print out the results
        print "<ol class='all'>\n";

        foreach ($randoms as $random) {

            print "<li class='random'> " . $random['fldRandomTask'] . " ";
            print "<ol><li>" . $random['fldDescription'] . "</li></ol>";
            print "</li>";
        }

        print "</ol>\n";
        ?>




        <?php
//Form to submit a Random Task

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
         
       /*$dbUserName = 'khearn_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = 'KHEARN_RANDOM_TASK'; */
        $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName); 

        $randomTask = "";
        $comments = "";

        $randomTaskERROR = false;
        $commentsERROR = false;

// create array to hold error messages filled (if any) in 2d displayed in 3c.
        $errorMsg = array();
// array used to hold form values that will be written to a CSV file
        $dataRecord = array();
        $mailed = false; // have we mailed the information to the user?

        if (isset($_POST["btnSubmit"])) {

            $randomTask = htmlentities($_POST["txtRandomTask"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $randomTask;
            $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $comments;


            $query = "INSERT INTO tblRandomTask (pmkRandomTaskId, fldRandomTask, fldDescription) VALUES ('" . $taskId . "', '" . $randomTask . "', '" . $comments . "')";

            
              $server = "webdb.uvm.edu";
              $user =  "mljoy_admin";
              $myPassword = "TwV28wTWrWZz95vk";
              $dataBase = "MLJOY_RANDOM_TASK"; 
             
            /*$server = "webdb.uvm.edu";
            $user = "khearn_admin";
            $myPassword = "NetWt24oz";
            $dataBase = "KHEARN_RANDOM_TASK"; */

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

            /*
              if (!securityCheck(true)) {
              $msg = "<p>Sorry you cannot access this page. ";
              $msg.= "Security breach detected and reported</p>";
              die($msg);
              }
             */
            //Sanitize
            $randomTask = htmlentities($_POST["txtRandomTask"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $randomTask;
            $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $comments;

            //Validate
            if ($randomTask == "") {
                $errorMsg[] = "Please enter a Random Task";
                $randomTaskERROR = true;
            } elseif (!verifyAlphaNum($randomTask)) {
                $errorMsg[] = "Your Random Task appears to have extra character.";
                $randomTaskERROR = true;
            }


            // Passed Validation 
            if (!$errorMsg) {
                if ($debug)
                    print "<p>Form is valid</p>";
            }
        }

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

        <div>
            <!-- Random Task Display -->
            <?php
            if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
                print "<h1> Thank you for submitting a Random Task </h1>";
            } else {
                if ($errorMsg) {
                    print '<div id="errors">';
                    print "<ol>\n";
                    foreach ($errorMsg as $err) {
                        print "<li>" . $err . "</li>\n";
                    }
                    print "</ol>\n";
                    print '</div>';}
                }
            
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
                                  style="width: 25em; height: 4em;" ><?php print $comments; ?>
                        </textarea>

                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Who Throws a Shoe!?" tabindex="900" class="button">
                    </fieldset>
                </form>
            </div>
        </aside>
    </article>

    <?php

include ('include/footer.php');
?>


</body>
</html>