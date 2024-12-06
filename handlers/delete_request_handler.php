<?php

session_start();
if(!empty($_SESSION["id"])){
    #Check if the user is an employee only employee can create a new request!
    if($_SESSION["isManager"] == 1){
        header("Location: ../manager.php");
        exit();
    }    
}else{
    #User has not logged in!
    header("Location: ../login.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST") {

$id = htmlspecialchars($_POST["id"]);
try {
    require_once "../includes/db.php";    
    $query = "DELETE FROM requests WHERE id = (?)";
    $stmt = $pdo->prepare($query);       
    $stmt->execute([$id]);
    $pdo = null;
    $statement =  null;
    header("Location: ../employee.php");
    exit();   
} catch (PDOException $e){
    die("Query failed: " . $e->getMessage());
}

}else{
    //Not a POST method used
    header("Location: ./login.php");
}