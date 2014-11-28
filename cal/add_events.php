<?php
// Values received via ajax
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
// insert the records
$sql = "INSERT INTO tblTasks (fldTask, fldToDoDate, fldDescription) VALUES (:title, :start, :url)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':url'=>$url));
?>