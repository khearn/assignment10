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
    
    <?php
$debug=false;
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

    
    /* ##### Step two 
     * 
     * open the file that contains the query

    */
    //$myfile = fopen("q01.sql", "r") or die("Unable to open file!");
    $query = "SELECT fldTask as Task, fldToDoDate as Date FROM tblTasks ORDER BY fldToDoDate ASC";

    $date_query = "SELECT fldToDoDate, fldTask FROM tblTasks ORDER BY fldToDoDate ASC";
    $task_query = "SELECT fldTask FROM tblTasks WHERE fldToDoDate='".$date_query."'";
    /* ##### Step three
     * Execute the query

     *      */
    $results = $thisDatabase->select($query);

    
     /* ##### Step four
     * prepare output and loop through array

     *      */
    $numberRecords = count($results);

    print "<table>";

    $firstTime = true;

    /* since it is associative array display the field names */
    foreach ($results as $row) {
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
        
        /* display the data, the array is both associative and index so we are
         *  skipping the index otherwise records are doubled up */
        print "<tr>";
        foreach ($row as $field => $value) {
            if (!is_int($field)) {
                print "<td>" . $value . "</td>";
            }
        }
        print "</tr>";
    }
    print "</table>";
    ?>
    
    <!-- I literally have no idea what I am doing. -->
    <?php 
    function __toString(){
		// The string we return is outputted by the echo statement
		return '
			<li id="todo'.$this->data['pmkTaskId'].'" class="todo">
			
				<div class="text">'.$this->data['fldTask'].'</div>
				
				<div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
				<div class="text">'.$this->data['fldToDoDate'].'</div>
				
				<div class="actions">
					<a href="#" class="edit">Edit</a>
					<a href="#" class="delete">Delete</a>
				</div>
				
			</li>';
	}
    ?>
    
    
    <!-- http://php.about.com/od/finishedphp1/ss/php_calendar_5.htm#step-heading -->
    <?php
    /*
//This gets today's date
    $date = time();

//This puts the day, month, and year in seperate variables
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);

//Here we generate the first day of the month
    $first_day = mktime(0, 0, 0, $month, 1, $year);

//This gets us the month name
    $title = date('F', $first_day);



//Here we find out what day of the week the first day of the month falls on 
    $day_of_week = date('D', $first_day);
//Once we know what day of the week it falls on, we know how many blank days occure before it. 
//If the first day of the week is a Sunday then it would be zero 
    switch ($day_of_week) {
        case "Sun": $blank = 0;
            break;
        case "Mon": $blank = 1;
            break;
        case "Tue": $blank = 2;
            break;
        case "Wed": $blank = 3;
            break;
        case "Thu": $blank = 4;
            break;
        case "Fri": $blank = 5;
            break;
        case "Sat": $blank = 6;
            break;
    }
//We then determine how many days are in the current month 
    $days_in_month = cal_days_in_month(0, $month, $year);



//Here we start building the table heads 
    echo '<table id="cal">';
    echo "<caption> $title $year </caption>";
    echo "<tr><th>Sunday</th><td>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr>";
//This counts the days in the week, up to 7
    $day_count = 1;
    echo "<tr>";
//first we take care of those blank days
    while ($blank > 0) {
        echo "<td></td>";
        $blank = $blank - 1;
        $day_count++;
    }


//sets the first day of the month to 1 
    $day_num = 1;
//count up the days, until we've done all of them in the month 
    while ($day_num <= $days_in_month) {
        echo "<td> $day_num </td>";
        $day_num++;
        $day_count++;
//Make sure we start a new row every week 
        if ($day_count > 7) {
            echo "</tr><tr>";
            $day_count = 1;
        }
    }



    //Finaly we finish out the table with some blank details if needed  
    while ($day_count > 1 && $day_count <= 7) {
        echo "<td> </td>";
    //    $day_count++;
    }
    echo "</tr></table>";
     * 
     */
    ?>
    <!-- Finished calender -->


    <!-- Add events to calendar -->
    <!-- http://stackoverflow.com/questions/13935230/add-events-to-full-calendar-and-store-them-on-mysql-through-servlet-callback -->

    <script>
        dayClick: function(date, allDay, jsEvent, view) {

            var year = date.getFullYear();
            var month = date.getMonth();
            month++;
            var day = date.getDate();
            var hour = date.getHours();
            var minute = date.getMinutes();

            $.facebox({ajax: '/addeditevent.php?year=' + year + '&month=' + month + '&day=' + day + '&hour=' + hour + '&minute=' + minute});

        }
        
    </script>
    <!-- end add events to calendar -->


    
    
    <!-- to do list -->
    <!-- http://www.html5rocks.com/en/tutorials/webdatabase/todo/ -->
    <script>

        var html5rocks = {};
        html5rocks.webdb = {};

        //Opening the database
        html5rocks.webdb.db = null;

        html5rocks.webdb.open = function () {
            var dbSize = 5 * 1024 * 1024; // 5MB
            html5rocks.webdb.db = openDatabase("Todo", "1", "Todo manager", dbSize);
        };

        html5rocks.webdb.onError = function (tx, e) {
            alert("There has been an error: " + e.message);
        };

        html5rocks.webdb.onSuccess = function (tx, r) {
            // re-render the data.
            // loadTodoItems is defined in Step 4a
            html5rocks.webdb.getAllTodoItems(loadTodoItems);
        };


        //Create a table
        //ID - a incrementing sequential ID column
        //todo - a text column that is the body of the item
        //added_on - the time that the todo item was created

        html5rocks.webdb.createTable = function () {
            var db = html5rocks.webdb.db;
            db.transaction(function (tx) {
                tx.executeSql("CREATE TABLE IF NOT EXISTS " +
                        "tblTasks(ID INTEGER PRIMARY KEY ASC, todo TEXT, added_on DATETIME)", []);
            });
        };

        //Adding data to a table
        html5rocks.webdb.addTodo = function (todoText) {
            var db = html5rocks.webdb.db;
            db.transaction(function (tx) {
                var addedOn = new Date();
                tx.executeSql("INSERT INTO tblTasks(todo, added_on) VALUES (?,?)",
                        [todoText, addedOn],
                        html5rocks.webdb.onSuccess,
                        html5rocks.webdb.onError);
            });
        };

        //Selecting data from a table
        html5rocks.webdb.getAllTodoItems = function (renderFunc) {
            var db = html5rocks.webdb.db;
            db.transaction(function (tx) {
                tx.executeSql("SELECT * FROM tblTasks", [], renderFunc,
                        html5rocks.webdb.onError);
            });
        };

        //Rendering data from a table
        function loadTodoItems(tx, rs) {
            var rowOutput = "";
            var todoItems = document.getElementById("tblTasksItems");
            for (var i = 0; i < rs.rows.length; i++) {
                rowOutput += renderTodo(rs.rows.item(i));
            }

            todoItems.innerHTML = rowOutput;
        }
        function renderTodo(row) {
            return "<li>" + row.todo +
                    " [<a href='javascript:void(0);' onclick=\'html5rocks.webdb.deletetblTasks(" +
                    row.ID + ");\'>Delete</a>]</li>";
        }

        //Deleting data from a table
        html5rocks.webdb.deleteTodo = function (id) {
            var db = html5rocks.webdb.db;
            db.transaction(function (tx) {
                tx.executeSql("DELETE FROM tblTasks WHERE ID=?", [id],
                        html5rocks.webdb.onSuccess,
                        html5rocks.webdb.onError);
            });
        };


        //Hooking it all up
        ....
                function init() {
                    html5rocks.webdb.open();
                    html5rocks.webdb.createTable();
                    html5rocks.webdb.getAllTodoItems(loadTodoItems);
                }
    </script>

    <aside onload="init();">

        <script>
            function addTodo() {
                var todo = document.getElementById("tblTasks");
                html5rocks.webdb.addTodo(todo.value);
                todo.value = "";
            }



        </script>  

    </aside>
</article>

<?php
include ('include/footer.php');
?>


</body>
</html>