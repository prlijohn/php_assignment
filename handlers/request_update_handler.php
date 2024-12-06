<?php
session_start();
if(!empty($_SESSION["id"])){
    #Check if the user is an employee
    if($_SESSION["isManager"] == 0){
        header("Location: ../employee.php");
        exit();
    }    
}else{
    #User has not logged in!
    header("Location: ../login.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST") {

$status = htmlspecialchars($_POST["status"]);
$id = htmlspecialchars($_POST["id"]);

try {
    require_once "../includes/db.php";    
    $query = "UPDATE requests SET status = (?) WHERE id = (?)";
    $statement = $pdo->prepare($query);
    $statement->execute([$status,$id]);
    // free up resources
    var_dump($statement);
    $pdo = null;
    $statement =  null;
    header("Location: ../manager.php");
    exit();
    
    
} catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

}else{
//Not a POST method used
header("Location: ../manager.php");
}