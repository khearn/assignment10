<?php
/* the purpose of this page is to accept the hashed date joined and primary key  
 * as passed into this page in the GET format.
 * 
 * I retrieve the date joined from the table for this person and verify that 
 * they are the same. After which i update the confirmed field and acknowlege 
 * to the user they were successful. Then i send an email to the system admin 
 * to approve their membership 
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 * Last updated on: October 17, 2014
 * 
 */

include "top.php";

print '<article id="main">';

print '<h1>Registration Confirmation</h1>';

print '<p>Thank you for confirming your account.  An administrator will look over your submition and will send you a follow up email when your account is officially approved.</p>';

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// variables for the classroom purposes to help find errors.

require_once('../bin/myDatabase.php');
$dbUserName = get_current_user() . '_writer';
$whichPass = "w"; //flag for which one to use.
$dbName = strtoupper(get_current_user()) . '_RANDOM_TASK';
$thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

$debug = false;
if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    $debug = true;
}
if ($debug)
    print "<p>DEBUG MODE IS ON</p>";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%

$adminEmail = "khearn@uvm.edu";
$message = "<p>I am sorry but this project cannot be confrimed at this time. Please call (802) 656-1234 for help in resolving this matter.</p>";


//##############################################################
//
// SECTION: 2 
// 
// process request

if (isset($_GET["q"])) {
    $key1 = htmlentities($_GET["q"], ENT_QUOTES, "UTF-8");
    $key2 = htmlentities($_GET["w"], ENT_QUOTES, "UTF-8");

    $data = array($key2);
    //##############################################################
    // get the membership record 

    $query = "SELECT fldDate FROM tblUsers WHERE pmkEmail = ? ";
    $results = $thisDatabase->select($query, $data);

    $date = $results[0]["fldDate"];
    $email = $results[0]["pmkEmail"];

    $k1 = sha1($date);
    $confirm = sha1($email);
//    $approved = sha1($confirm);

    if ($debug) {
        print "<p>Date: " . $date . "</p>";
        print "<p>email: " . $email . "</p>";
        print "<p><pre>";
        print_r($results);
        print "</pre></p>";
        print "<p>k1: " . $k1 . "</p>";
        print "<p>q : " . $key1 . "</p>";
    }
    //##############################################################
    // update confirmed
    if ($key1 == $k1) {
        if ($debug)
            print "<h1>Confirmed</h1>";

        $query = "UPDATE tblUsers SET fldHash=1 WHERE pmkEmail = ? ";
        $data = array($confirm);
        $data[] = $approved;
        $results = $thisDatabase->update($query, $data);
        if ($results) {
                echo "Successful";
                echo "<BR>";
                echo "<a href='home.php'>Back to main Page</a>";
            } elseif (!$results)  {
                echo "ERROR. There was a problem with accpeting your data please contact us directly.";
            }


        if ($debug) {
            print "<p>Query: " . $query;
            print "<p><pre>";
            print_r($results);
            print_r($data);
            print "</pre></p>";
        }
        // notify admin
        $message = '<h2>The following Registration has been confirmed:</h2>';

        $message = "<p>Click this link to approve this registration: ";
        $message .= '<a href="' . $domain . $path_parts["dirname"] . '/approve.php?q=' . $key2 . '">Approve Registration</a></p>';
        $message .= "<p>or copy and paste this url into a web browser: ";
        $message .= $path_parts["dirname"] . '/approve.php?q=' . $key2 . "</p>";

        if ($debug)
            print "<p>" . $message;

        $to = $email;
        $cc = "";
        $bcc = "$adminEmail";
        $from = "SomeStuff <noreply@yoursite.com>";
        $subject = "SomeStuff Confirmed: Approve?";
        $messageE = "<p>Your membership has been approved. Welcome Aboard!</p>";

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        if ($debug) {
            print "<p>";
            if (!$mailed) {
                print "NOT ";
            }
            print "mailed to admin ". $to . ".</p>";
        }

       /* // notify user
        $to = $email;
        $cc = "";
        $bcc = "";
        $from = "SomeStuff <noreply@yoursite.com>";
        $subject = "SomeStuff Registration Confirmed";
        $message = "<p>Thank you for taking the time to confirm your registration. Once your membership has been approved we look forward to sending you junk mail.</p>";

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);

        print $message;
        if ($debug) {
            print "<p>";
            if (!$mailed) {
                print "NOT ";
            }
            print "mailed to member: " . $to . ".</p>";
        }*/
    }else{
        print $message;
    }
      
} // ends isset get q

print "</article>";

include "footer.php";
if ($debug)
    print "<p>END OF PROCESSING</p>";
?>

</body>
</html>