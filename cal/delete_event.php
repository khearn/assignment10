<?php

$sql = "DELETE FROM tblTasks WHERE pmkTaskId=" . $id;
$q = $bdd->prepare($sql);
$q->execute();
?>