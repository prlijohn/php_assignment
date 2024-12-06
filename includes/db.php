<?php
#default db configuration
$dsn = "mysql:host=localhost;dbname=assignment";
$dbusername = "root";
$dbpassword = "";


try {
    //creation of an object that represent my db
    //i access this for every sql query 
    $pdo = new PDO( $dsn , $dbusername , $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed:". $e->getMessage();
}