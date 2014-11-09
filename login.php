<?php //include 'checklogin.php'; ?>
<!--
<header id="login">
    <form name="form1" method="post" action="checklogin.php">
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
        <input type="submit" id="btnSubmit" name="btnSubmit" value="Login" tabindex="900" class="button">
    </form>
</header>
-->
<?php

$submitted_email = ''; 
     
    // This if statement checks to determine whether the login form has been submitted 
    // If it has, then the login code is run, otherwise the form is displayed 
    if(!empty($_POST)) 
    { 
        // This query retreives the user's information from the database using 
        // their username. 
        $query = " SELECT pmkEmail, fldPassword FROM tblUsers WHERE pmkEmail =" . $submitted_email;
         
        // The parameter values 
        $query_params = array( 
            $submitted_email => $_POST['pmkEmail'] 
        ); 
         
        try 
        { 
            // Execute the query against the database 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // This variable tells us whether the user has successfully logged in or not. 
        // We initialize it to false, assuming they have not. 
        // If we determine that they have entered the right details, then we switch it to true. 
        $login_ok = false; 
         
        // Retrieve the user data from the database.  If $row is false, then the username 
        // they entered is not registered. 
        $row = $stmt->fetch(); 
        if($row) 
        { 
            // Using the password submitted by the user and the salt stored in the database, 
            // we now check to see whether the passwords match by hashing the submitted password 
            // and comparing it to the hashed version already stored in the database. 
            $check_password = hash('sha256', $_POST['fldPassword']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['fldPassword']); 
            } 
             
            if($check_password === $row['fldPassword']) 
            { 
                // If they do, then we flip this to true 
                $login_ok = true; 
            } 
        } 
         
        // If the user logged in successfully, then we send them to the private members-only page 
        // Otherwise, we display a login failed message and show the login form again 
        if($login_ok) 
        { 
            // Here I am preparing to store the $row array into the $_SESSION by 
            // removing the salt and password values from it.  Although $_SESSION is 
            // stored on the server-side, there is no reason to store sensitive values 
            // in it unless you have to.  Thus, it is best practice to remove these 
            // sensitive values first. 
            //unset($row['salt']); 
            unset($row['fldPassword']); 
             
            // This stores the user's data into the session at the index 'user'. 
            // We will check this index on the private members-only page to determine whether 
            // or not the user is logged in.  We can also use it to retrieve 
            // the user's details. 
            $_SESSION['pmkEmail'] = $row; 
             
            // Redirect the user to the private members-only page. 
            header("Location: profile.php"); 
            die("Redirecting to: profile.php"); 
        } 
        else 
        { 
            // Tell the user they failed 
            print("Login Failed."); 
             
            // Show them their username again so all they have to do is enter a new 
            // password.  The use of htmlentities prevents XSS attacks.  You should 
            // always use htmlentities on user submitted values before displaying them 
            // to any users (including the user that submitted them).  For more information: 
            // http://en.wikipedia.org/wiki/XSS_attack 
            $submitted_email = htmlentities($_POST['pmkEmail'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 
<h1>Login</h1> 
<form action="login.php" method="post"> 
<label for="txtEmail">Email
            <input type="text" id="txtEmail" name="txtEmail"
                   value="<?php print $submitted_email ?>"
                   tabindex="300" maxlength="45" placeholder="Please enter a valid Email Address"
                   onfocus="this.select()"
                   >
        </label>
        <label for="txtPassword">Password
                    <input type="password" id="pwdPassword" name="pwdPassword"
                           value="<?php print $check_password ?>"
                           tabindex="400" maxlength="45" placeholder="Please enter a valid Email Address"
                           onfocus="this.select()"
                           >
                </label>
        <input type="submit" id="btnSubmit" name="btnSubmit" value="Login" tabindex="900" class="button">
</form> 
<a href="register.php">Register</a>