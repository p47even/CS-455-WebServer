<!DOCTYPE html>
<html>
<body>

<form action="showPassengers.php" name='form' method='get'>
Attr: <input type="text" name="attr" id="attr"><br>
<form action="showPassengers.php" name='form' method='get'>
Var: <input type="text" name="var" id="var"><br>
<input type="submit" name="submit" value="Submit">

<h2>Query Results</h2>
<p>
    <?php

        //path to the SQLite database file
        $db_file = './myDB/airport.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return the html query
            $query_str = "select * from passengers where $_GET[attr]='$_GET[var]';"; // <------ Line 19
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
            foreach($result_set as $tuple) {          // <------ Line 24
                echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]<br/>\n";
            }

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