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