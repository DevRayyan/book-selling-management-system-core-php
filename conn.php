<?php

$server = 'localhost';
$username = 'root';
$password ="";
$database = 'ebook_website';
$con = mysqli_connect($server, $username, $password, $database);

if (!$con){
        die("Error". mysqli_connect_error());
    }
    

?>
