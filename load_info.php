<?php
    header('Content-Type: application/json');

    include('conf.php');

    $table = $_GET['table'];
    $field = $_GET['field'];

    if ($field != "") $value = $_GET['value'];

    $data = array();

    if ($table == "") {
        $data["error"] = "Select a table";
        die(json_encode($data));
    } else {
        $conn = @new mysqli(HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // check the db connection
        if ($conn->connect_error) {
            $data["error"] = "Database connection error";
            die(json_encode($data));
        }

        // load table rows
        if ($field != "" && $value != "") $query = "SELECT * FROM $table WHERE $field LIKE '%$value%'";
        else $query = "SELECT * FROM $table;";

        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $data["rows"] = array();
            $cont = 0;
            while($row = $result->fetch_assoc()) {
                $data["rows"][$cont] = array();
                foreach ($row as $key => $value) {
                    $data["rows"][$cont][$key] = utf8_encode($value);
                }
                $cont++;
            }
        } else {
            die(json_encode(array("noresult"=>"0 Persone trovate")));
        }
        $conn->close();
        die(json_encode($data));
    }
    die(json_encode(array("error"=>"generic error")));
?>
