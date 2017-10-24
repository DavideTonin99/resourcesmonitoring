<?php
    define("HOST", "");
    define("DB_USER", "");
    define("DB_PASSWORD", "");
    define("DB_NAME", "");

    $table = $_GET['table'];
    $field = $_GET['field'];
    if ($field != "") $value = $_GET['value'];

    if ($table == "") {
        echo "<h3>Select an option to view information</h3>";
    } else {
        $conn = @new mysqli(HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // check the db connection
        if ($conn->connect_error) {
            echo "<h2>Database connection error</h2>";
            return;
        }

        echo "<div id='table-container'><table class='table table-striped table-bordered'>";

        // load table fields
        $query = "SHOW COLUMNS FROM $table";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<tr>";
            while($row = $result->fetch_assoc()){
                echo "<th>".$row['Field']."</th>";
            }
            echo "</tr>";
        }

        // load table rows
        if ($field != "" && $value != "") $query = "SELECT * FROM $table WHERE $field LIKE '%$value%'";
        else $query = "SELECT * FROM $table;";

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<h3 style='text-decoration: underline;'>0 results</h3>";
        }
        echo "</table></div>";

        $current_dir = getcwd();
        if (file_exists($current_dir."/xml")) {
            echo "<hr /><div id='xml-container'><h4 style='color:#005c99;'>File xml:</h4><ul>";
            $files = scandir($current_dir."/xml");
            $cont = 0;
            foreach ($files as $filename) {
                $file = new SplFileInfo("./xml/".$filename);
                $exist = strpos($filename, $table);

                if ($exist !== false && $file->getExtension() == "xml") {
                    echo "<li><a href='./xml/$filename' target='_blank'>$filename</a></li>";
                    $cont++;
                }
            }
            if ($cont == 0) {
                echo "<h3 style='color:#00b386; text-decoration: underline;'>No files xml found</h3>";
            }
            echo "</ul></div>";
        }
    }

?>
