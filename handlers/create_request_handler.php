<?php

#Check if the user has logged in
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

    //Retrieve the id of the connected user via (GV) _SESSION 
    $user_id = $_SESSION["id"];
    $from = htmlspecialchars($_POST["from"]);
    $to = htmlspecialchars($_POST["to"]);
    $status = "PENDING";
    $reason = htmlspecialchars($_POST["reason"]);
    

    try {
        require_once "../includes/db.php";
        $query = "INSERT INTO requests (user_id,date_from,date_to,reason,status) VALUES (?,?,?,?,?)";
        $statement = $pdo->prepare($query);
        $statement->execute([$user_id,$from,$to,$reason,$status]);
        // free up resources
        $pdo = null;
        $statement =  null;        
        header("Location: ../employee.php");
        exit();
        
        
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}else{
    //Not a POST method used
    header("Location: ./index.php");
}
