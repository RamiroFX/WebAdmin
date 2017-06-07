<?php

$hostname = "localhost";
$database = "bakermanager";
$username = "root";
$password = "";
$conex = mysqli_connect($hostname, $username, $password, $database);
error_reporting(E_ALL);
ini_set("display_errors", 1);
mysqli_set_charset($conex, 'utf8');
?>
<?php

/* if (is_file("includes/funciones.php")) {
  include("includes/funciones.php");
  } else {
  include("../includes/funciones.php");
  } */
?>