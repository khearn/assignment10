<?php

/* Values received via ajax */
$id = $_POST['pmkTaskId'];
$title = $_POST['fldTask'];
$start = $_POST['fldToDoDate'];
$url = $_POST['fldDescription'];

// connection to the database

 try {
 $bdd = new PDO('mysql:host=khearn_writer;dbname=KHEARN_RANDOM_TASK', 'root', 'root');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 
 // update the records
$sql = "UPDATE tblTasks SET fldTask=?, fldToDoDate=?, fldDescription=? WHERE pmkTaskId=?";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$url,$id));
?>