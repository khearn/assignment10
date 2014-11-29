<?php 
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Random Task</title>
        <meta charset="utf-8">
        <meta name="author" content="Mallory Joy & Kylie Hearn">
        <meta name="description" content="Random Task is a website that reminds you of things you have to do. The idea is that you will submit a task and on the day you have to do it, we will send you either an email or a text message reminding you to do said task.">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="css/randomTask.css" type="text/css" media="screen">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script>
            $(function () {
                $("#datepicker").datepicker({dateFormat: "yy-mm-dd"});
            });
        </script>


        <?php
        $debug = false;
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }
        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
        $domain .= $server;
        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//
        require_once('lib/security.php');
        //if (($path_parts['filename'] == "register") OR ($path_parts['filename'] == "manage_task") OR ($path_parts['filename'] == "login/login")) {
        require "lib/validation-functions.php";
        require "lib/mail-message.php";
        //include "cookie.php";
        //}
        ?>	

        <script>
            $(document).ready(function () {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            })
        </script>

    </head>
    <!-- ################ body section ######################### -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    ?>