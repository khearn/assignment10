<?php
$cookie_name = "password";
$cookie_value = "23";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
// 86400 = 1 day
?>