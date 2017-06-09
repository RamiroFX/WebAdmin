<?php

$dbuser = 'postgres';
$dbpassword = 'postgres';
$dbname = 'bakermanagerdev';
$host = 'localhost';
try {
    $CON = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpassword, [
       PDO::ATTR_EMULATE_PREPARES => false, 
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ]); 
} catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}
?>
