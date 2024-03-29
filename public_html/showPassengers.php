<!DOCTYPE html>
<html>
<body>
<h2>Query Results</h2>
<p>

<a href="./htmlForm.php?oldSsn=&oldFName=&oldMName=&oldLName=&msg=">Add New Passenger</a><br><br>

    <?php
        //path to the SQLite database file
        $db_file = './myDB/airport.db';

        

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return the html query
            $query_str = "select * from passengers;"; // <------ Line 19
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            foreach($result_set as $tuple) {          // <------ Line 24
                echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name] \t<a href='./htmlForm.php?oldSsn=$tuple[ssn]&oldFName=$tuple[f_name]&oldMName=$tuple[m_name]&oldLName=$tuple[l_name]&msg='> Update </a> <br/>\n";
            }
            
            echo "<br><br>";
            echo $_GET['msg'] .= "";

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>

</p>
    <a href="./index.html">return to homepage</a>
</body>
</html>