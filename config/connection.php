<?php
    // database credentials
    $SERVER = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DATABASE = "blood_bank";

    // create connection
    $conn = mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE) or die("Not connected to database");
?>