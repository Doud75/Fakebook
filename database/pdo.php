<?php
$engine = "mysql";
$host = "localhost";
$port = 3306; //à modiffier si besoin
$dbname = "";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbname", $username, $password);
?>