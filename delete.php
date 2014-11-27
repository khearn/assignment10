<?php
include "top.php";
?>
<article>
    <aside>
<?php
// Definately not working

if (isset($_GET["pmkTaskId"])) {
    $index = $_GET["pmkTaskId"];
    $query = 'DELETE * FROM tblTasks WHERE pmkTaskId = "'.$index.'" ';
    $results = $thisDatabase->select($query);

}

if ($results) { // closing of if marked with: end body submit
    print "<h1>Task Deleted</h1> ";
    print "<p>Return to you <a href='profile.php'>Task List</a></p>";
} elseif (!$results) {
    print "<h1>Task Not Deleted</h1> ";
    print "<p>Return to your <a href='profile.php'>Task List</a></p>";
}

//Notice: Undefined variable: results in /users/k/h/khearn/www-root/cs148/assignment10/delete.php on line 14 Notice: Undefined variable: results in /users/k/h/khearn/www-root/cs148/assignment10/delete.php on line 17


?>
    </aside>
</article>
    <?php
    include "footer.php";
    if ($debug)
        print "<p>END OF PROCESSING</p>";
    ?>
</body>
</html>