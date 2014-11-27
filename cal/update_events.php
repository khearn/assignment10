<?php

/* Values received via ajax */
$id = $_POST['pmkTaskId'];
$title = $_POST['fldTask'];
$start = $_POST['fldToDoDate'];
$url = $_POST['fldDescription'];

// connection to the database
try {
 $bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', 'root');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // update the records
$sql = "UPDATE tblTasks SET fldTask=?, fldToDoDate=?, fldDescription=? WHERE pmkTaskId=?";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$url,$id));
?>