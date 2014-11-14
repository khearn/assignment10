<?php
// Set session variables
$_SESSION["pmkUsername"] = $username;
$_SESSION["pmkEmail"] = $email;
$_SESSION["fldPassword"] = $hash;
echo "Session variables are set.";
?>