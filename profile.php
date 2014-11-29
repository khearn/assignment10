<?php
include "include/top.php";
//session_start();
//include "session_start.php";
//include ('login.php');
include "include/header.php";
include "include/nav.php";
?>

<!-- user nav bar. That way when you log in it should auto send you to profile.php, so no one without an account can see the user only pages -->


<article>
    <h2>Profile</h2>    
    <aside>
        <?php
        $debug = false;
//############################################################################
//
// This page lists your tables and fields within your database. if you click on
// a database name it will show you all the records for that table.
//
//############################################################################
// set up variables for database
        require_once('../bin/myDatabase.php');
        $dbUserName = 'khearn_writer';
        $whichPass = "w"; //flag for which one to use.
        $dbName = 'KHEARN_RANDOM_TASK';
        $thisDatabase = new myDatabase($dbUserName, $whichPass, $dbName);

        /* ##### html setup */

        $phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
        $path_parts = pathinfo($phpSelf);
        print '<body id="' . $path_parts['filename'] . '">';

        // ##### Step two 
        // ##### Step three
        // ##### Step four

print "<article>";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// prepare the sql statement
$orderBy = "ORDER BY fldToDoDate ASC ";

$query  = "SELECT fldTask, fldDescription, fldToDoDate ";
$query .= "FROM tblTasks " . $orderBy;

if ($debug)
    print "<p>sql" . $query;

$dates = $thisDatabase->select($query);

if ($debug) {
    print "<pre>";
    print_r($dates);
    print "</pre>";
}

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// print out the results
print "<ol>\n";

foreach ($dates as $date) {

    print "<li class='tasks'>";

    //if ($admin) {
    print "<table>";
        print "<tr>";
        print "<td>";
            print '<a href="manage_task.php?id=' . $date["pmkTaskId"] . '">[Edit]</a> ';
        print "</td>";
        print "<td>";
            print '<a href="delete.php?id=' . $date["pmkTaskId"] . '">[Delete]</a> ';
        print "</td>";
    //}
        print "<td>";
            print "<div class='date'>" . $date['fldToDoDate'] . "</div>";
        print "</td>";
        print "<td>";
            print '<div class="task">' . $date['fldTask'] . '</div>';
        print "</td>";
        print "<td>";
            print '<div class="text">' . $date['fldDescription'] . '</div>';
        print "</td>";
        print "</tr>";
    print "</table>";
}

    print "</li>\n";
print "</ol>\n";
print "</article>";

/*
        print "<table>";

        $firstTime = true;
*/
        /* since it is associative array display the field names */
/*        foreach ($results as $row) {
            if ($firstTime) {
                print "<thead><tr>";
                $keys = array_keys($row);
                foreach ($keys as $key) {
                    if (!is_int($key)) {
                        print "<th>" . $key . "</th>";
                    }
                }
                print "</tr>";
                $firstTime = false;
            }
*/
            /* display the data, the array is both associative and index so we are
             *  skipping the index otherwise records are doubled up */
/*            print "<tr>";
            foreach ($row as $field => $value) {
                if (!is_int($field)) {
                    print "<td>" . $value . "</td>";
                }
            }
            print "</tr>";
        }
        print "</table>";\
 */
        ?>

        <!-- I literally have no idea what I am doing. -->
        <?php
/*
        function __toString() {
            // The string we return is outputted by the echo statement
            return '
			<li id="todo' . $this->data['pmkTaskId'] . '" class="todo">
			
				<div class="text">' . $this->data['fldTask'] . '</div>
				
				<div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
				<div class="text">' . $this->data['fldToDoDate'] . '</div>
				
				<div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
			</li>';
        }
 * 
 */
        
        
    include 'cal/default.php';
        ?>
      
        
        
    </aside>
</article>

<?php
include ('include/footer.php');
?>


</body>
</html>