<?php ini_set('display_errors',1); error_reporting(E_ALL); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Random Task</title>
        <meta charset="utf-8">
        <meta name="author" content="Mallory">
        <meta name="description" content="Homework">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

<<<<<<< HEAD
        <link rel="stylesheet" href="randomTask.css" type="text/css" media="screen">
=======
        <link rel="stylesheet" href="style.css" type="text/css" media="screen">
>>>>>>> FETCH_HEAD


        <?php
        $debug = false;
<<<<<<< HEAD
=======

>>>>>>> FETCH_HEAD
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
//  $domain = "https://www.uvm.edu" or http://www.uvm.edu;
<<<<<<< HEAD
=======

>>>>>>> FETCH_HEAD
        $domain = "http://";
        if (isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS']) {
                $domain = "https://";
            }
        }
<<<<<<< HEAD
        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
        $domain .= $server;
        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
=======

        $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");

        $domain .= $server;

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

        $path_parts = pathinfo($phpSelf);

>>>>>>> FETCH_HEAD
        if ($debug) {
            print "<p>Domain" . $domain;
            print "<p>php Self" . $phpSelf;
            print "<p>Path Parts<pre>";
            print_r($path_parts);
            print "</pre>";
        }
<<<<<<< HEAD
=======

>>>>>>> FETCH_HEAD
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries
//
<<<<<<< HEAD
        require_once('lib/security.php');
        //if ($path_parts['filename'] == "form" || $path_parts['filename'] == "crud") {
            require "lib/validation-functions.php";
            require "lib/mail-message.php";
=======

        require_once('lib/security.php');

        //if ($path_parts['filename'] == "form" || $path_parts['filename'] == "crud") {
            require "lib/validation_functions.php";
            require "lib/mailMessage.php";
>>>>>>> FETCH_HEAD
        //}
        ?>	

    </head>
    <!-- ################ body section ######################### -->

<<<<<<< HEAD
=======
    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    
    include "header.php";
    include "nav.php";
    ?>
>>>>>>> FETCH_HEAD
    
    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    ?>
