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

        <link rel="stylesheet" href="randomTask.css" type="text/css" media="screen">

        <!--        <link rel="shortcut icon" href="eighth-note.ico" type="image/x-icon">
                <link rel="icon" href="eighth-note.ico" type="image/x-icon">-->

        <?php
        require_once('../bin/myDatabase.php');

        $dbUserName = 'khearn_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = 'KHEARN_RANDOM_TASK';
        ?>

    </head>

    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    ?>