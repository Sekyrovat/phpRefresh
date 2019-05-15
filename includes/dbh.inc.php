<?php

function connect()
{
    $servername = "192.168.10.10";
    $username = "homestead";
    $password = "secret";
    $dbname = "webApp";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        return null;
    } else {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn->set_charset("utf8mb4");
        $conn->select_db($dbname);
        return $conn;
    }
}

?>