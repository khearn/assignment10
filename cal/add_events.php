<?php
// Values received via ajax
$title = $_POST['fldTask'];
$start = $_POST['fldToDoDate'];
$url = $_POST['fldDescription'];

// connection to the database
try {
$bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', 'root');
} catch(Exception $e) {
exit('Unable to connect to database.');
}

// insert the records
$sql = "INSERT INTO tblTasks (fldTask, fldToDoDate, fldDescription) VALUES (:title, :start, :url)";
$q = $bdd->prepare($sql);
$q->execute(array(':title'=>$title, ':start'=>$start, ':url'=>$url));
?>