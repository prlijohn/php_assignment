<?php

session_start();
if(!empty($_SESSION["id"])){
  if($_SESSION["isManager"] == 0){
    header("Location: ../home.php");
    exit();
  }       
}else{
  header("Location: ../login.php");
  exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
$id = htmlspecialchars($_POST["id"]);

try {
    require_once "../includes/db.php";    
    $query = "DELETE FROM users WHERE id = (?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    //free resources
    $pdo = null;
    $statement =  null;
    header("Location: ../home.php");
    exit();
    
    
} catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

}else{
//Not a POST method used
header("Location: ../login.php");
}