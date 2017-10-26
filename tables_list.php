<?php
    include('conf.php');

    $conn = @new mysqli(HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // check the db connection
    if ($conn->connect_error) {
        echo "Database connection error";
    } else {
        $query = "select table_name from information_schema.tables where TABLE_SCHEMA='".DB_NAME."';";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row['table_name']."'>".strtoupper($row['table_name'])."</option>";
            }
        }

        $conn->close();
    }
?>
