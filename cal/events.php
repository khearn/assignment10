<?php
// List of events
 $json = array();

 // Query that retrieves events
 $requete = "SELECT * FROM tblTasks ORDER BY pmkTaskId";

 // connection to the database
 try {
 $bdd = new PDO('mysql:host=khearn_writer;dbname=KHEARN_RANDOM_TASK', 'root', 'root');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // Execute the query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));
 // sending the encoded result to success page
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>