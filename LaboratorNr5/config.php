<?php
//conect db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gettech_db";

//create conect
$conn = new mysqli($servername, $username, $password, $dbname);

//verify conect
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>