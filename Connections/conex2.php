<?php

$dbuser = 'postgres';
$dbpassword = 'postgres';
$dbname = 'bakermanagerdev';
$host = 'localhost';
try {
    $conex = new PDO("pgsql:dbname=$dbname;host=$host", $dbuser, $dbpassword, [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo "Error : " . $e->getMessage() . "<br/>";
    die();
}
?>

<?php

if (is_file("includes/funciones2.php")) {
    include("includes/funciones2.php");
} else {
    include("../includes/funciones2.php");
}
?>