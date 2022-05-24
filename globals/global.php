<?php

$database = "localhost";
$db_name = "WebDiP2021x003";
$db_user = "WebDiP2021x003";
$db_pass = "admin_MFQi";

$connection = mysqli_connect($database, $db_user, $db_pass, $db_user);

if(!$connection){
    echo "<script> alert('Connection failed!') </script>";

    header("Location: ../index.php");
}




?>
