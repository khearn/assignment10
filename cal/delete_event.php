<?php

$sql = "DELETE FROM tblTasks WHERE pmkTaskId=" . $id;
$q = $thisDatabase->prepare($sql);
$q->execute();
?>