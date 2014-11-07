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
		$debug = false;

		if (isset($_GET["debug"])) { // ONLY do this in a classroom environment
    	$debug = true;
    	}
		?>
		
	<?php
		if ($debug)
	    print "<p>DEBUG MODE IS ON</p>";
        
        require_once('../bin/myDatabase.php');

        $dbUserName = 'mljoy_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = 'MLJOY_RANDOM_TASK';
        $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);
    ?>

    </head>

    <?php
    	print '<body id="' . $path_parts['filename'] . '">';
    ?>
    
