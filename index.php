<?php
include "include/top.php";
//include ('login.php');
include "include/header.php";
include "include/nav.php";
?>

<article>
    <h1>Welcome!</h1>
    <aside>
        <section class="text">
            <p>Here at Random Task, we strive to make your lives a little easier.  We understand that you have a lot going on in your life and at times it can be difficult to remember everything you have to do each day.  That is where we come in.</p>
            <p>Once you create an account you can enter in task or jobs that you have to do.  We will take that information and generate a calendar of your tasks as well as to do lists for each day.  You might be thinking, 'why bother?!  It's exactly the same as carrying around a planner.'  But you would be wrong to think this cause we wont stop there!</p>
            <p>Each day we will send you and email or a text with a list of your to do tasks for that day!  That way you don't have to remember to check your account!</p>

        </section>

        <section class="img">
            <img src="pic/joe-son-random-task.jpg" alt="Random Task with a cat">
        </section>
        <section class="text">
            <p>But any way if you still haven't figured out why the name of this website is funny, you clearly have never seen the greatest movies in existence!</p>
            <h3>Dr.Evils Henchmen</h3>

            <table>
                <tr>
                    <th>Frau Farbissina</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">She was the founder of the militant wing of the Salvation Army. Is now Dr. Evils attack and defense specialist, and is the mother of Dr. Evils son.</td>
                    <td><img src="pic/frau.jpg" alt="Frau" width="150"></td>
                </tr>

                <tr>
                    <th>Number 2</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">He is Dr. Evils second in command.  Is an excellent business man, and is a much better leader than Dr. Evil.</td>
                    <td><img src="pic/2.gif" alt="Number 2" width="150"></td>
                </tr>

                <tr>
                    <th>Random Task</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">Korean ex-wrestler, evil handyman extraordinaire. Random Task is a direct parody of Oddjob from the James Bond movie Goldfinger, but he throws a shoe instead of a hat .</td>
                    <td><img src="pic/rand.jpg" alt="Random Task" width="150"></td>
                </tr>

                <tr>
                    <th>Patty O'Brien</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">ex-Irish assassin.  His trademark - a superstitious man he leaves a tiny keepsake from his good luck bracelet on every victim he kills.  Scotland Yard would love to get their hands on that piece of evidence.</td>
                    <td><img src="pic/pat.gif" alt="Patty" width="150"></td>
                </tr>

                <tr>
                    <th>Mustafa</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">He is an Arab who wears a red fez. His life is spared by Dr. Evil at the start of the first film, but a second mistake also puts his life on the line. While he feels pain like everyone else, he is near-impossible to kill.</td>
                    <td><img src="pic/must.jpeg" alt="Mustafa" width="150"></td>
                </tr>

                <tr>
                    <th>Fat Bastard</th>
                    <th></th>
                </tr>
                <tr>
                    <td class="words">He is Scottish. He is incredibly foul-mouthed, and morbidly obese, weighing "a metric ton"; however, he thinks of himself as sexy, which he is heard calling himself, and believes that women find him irresistible.</td>
                    <td><img src="pic/fat.jpg" alt="Fat Bastard" width="150"></td>
                </tr>


                <!--
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                -->
            </table>


            <!--<p>More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here More text here</p>-->
        </section>

        <section class="img">
            <iframe class="video" width="640" height="360" src="//www.youtube.com/embed/pIwLJtqoxBs?rel=0" frameborder="0" allowfullscreen></iframe>
        </section>



        <?php
        $debug = false;
        if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
            $debug = true;
        }
        if ($debug)
            print "<p>DEBUG MODE IS ON</p>";

        $yourURL = $domain . $phpSelf;


        include "top.php";
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
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.


        $frau = false;
        $number2 = false;
        $random = false;
        $patty = false;
        $mustafa = false;
        $fat = false;

        $errorMsg = array();

        if (isset($_POST["btnSubmit"])) {
            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
    // SECTION: 2a Security
            // 
            if (!securityCheck(true)) {
                $msg = "<p>Sorry you cannot access this page. ";
                $msg.= "Security breach detected and reported</p>";
                die($msg);
            }

            if (isset($_POST["chkFrau"])) {
                $frau = true;
            } else {
                $frau = false;
            }
            $dataRecord[] = $frau;

            if (isset($_POST["chkNumber"])) {
                $number2 = true;
            } else {
                $number2 = false;
            }
            $dataRecord[] = $number2;

            if (isset($_POST["chkRandom"])) {
                $random = true;
            } else {
                $random = false;
            }
            $dataRecord[] = $random;

            if (isset($_POST["chkPatty"])) {
                $patty = true;
            } else {
                $patty = false;
            }
            $dataRecord[] = $patty;

            if (isset($_POST["chkMustafa"])) {
                $mustafa = true;
            } else {
                $mustafa = false;
            }
            $dataRecord[] = $mustafa;

            if (isset($_POST["chkFat"])) {
                $fat = true;
            } else {
                $fat = false;
            }
            $dataRecord[] = $fat;


            if (!$errorMsg) {
                if ($debug)
                    print "<p>Form is valid</p>";
                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                //
        // SECTION: 2e Save Data
                //
        // This block saves the data to a CSV file.
                $fileExt = ".csv";
                $myFileName = "data/HenchmenPoll";
                $filename = $myFileName . $fileExt;
                if ($debug)
                    print "\n\n<p>filename is " . $filename;
                // now we just open the file for append
                $file = fopen($filename, 'a');
                // write the forms informations
                fputcsv($file, $dataRecord);
                // close the file
                fclose($file);

                //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

                $message = '<h2>Your information.</h2>';
                foreach ($_POST as $key => $value) {
                    $message .= "<p>";
                    $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
                    foreach ($camelCase as $one) {
                        $message .= $one . " ";
                    }
                    $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
                }
            } // end form is valid
        } // ends if form was submitted.
        ?>

        <section class="text">

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
                print "<p>Thank you for giving us your opinions and junk!!</p>";
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


                <form action="<?php print $phpSelf; ?>"
                      method="post"
                      id="frmRegister">
                    <fieldset class="register">
                        <legend>Which of Dr. Evils Henchmen are your favorite?</legend>

                        <label><input type="checkbox" 
                                      id="chkFrau" 
                                      name="chkFrau" 
                                      value="Frau"
                                      <?php if ($frau) print ' checked '; ?>
                                      tabindex="420"> Frau Farbissina</label>

                        <label><input type="checkbox" 
                                      id="chkNumber" 
                                      name="chkNumber" 
                                      value="Number"
                                      <?php if ($number2) print ' checked '; ?>
                                      tabindex="430"> Number 2</label>
                        <label><input type="checkbox" 
                                      id="chkRandom" 
                                      name="chkRandom" 
                                      value="Random"
                                      <?php if ($random) print ' checked '; ?>
                                      tabindex="420"> Random Task</label>

                        <label><input type="checkbox" 
                                      id="chkPatty" 
                                      name="chkPatty" 
                                      value="Patty"
                                      <?php if ($patty) print ' checked '; ?>
                                      tabindex="430"> Patty O'Brien</label>
                        <label><input type="checkbox" 
                                      id="chkMustafa" 
                                      name="chkMustafa" 
                                      value="Mustafa"
                                      <?php if ($mustafa) print ' checked '; ?>
                                      tabindex="420"> Mustafa</label>

                        <label><input type="checkbox" 
                                      id="chkFat" 
                                      name="chkFat" 
                                      value="Fat"
                                      <?php if ($fat) print ' checked '; ?>
                                      tabindex="430"> Fat Bastard</label>

                        <input type="submit" id="btnSubmit" name="btnSubmit" value="Vote Now!" tabindex="900" class="button">

                    </fieldset>
                </form>
                <?php
            }
            ?>

        </section>
    </aside>
</article>

<?php
include ('include/footer.php');
?>


</body>
</html>