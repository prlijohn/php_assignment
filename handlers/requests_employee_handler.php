<?php
//This handler is used on employee home page
//Its purpose is to retrieve all the requests 
//that the logged in employee has sent to the manager
#Check if the user has logged in
if(!empty($_SESSION["id"])){
    #Check if the user is an employee
    if($_SESSION["isManager"] == 1){
        header("Location: ../manager.php");
        exit();
    }    
}else{
    #User has not logged in!
    header("Location: ../login.php");
    exit();
}
#Checking for a GET method
if($_SERVER["REQUEST_METHOD"] == "GET") {
    try{        
        require_once "./includes/db.php";
        $user_id = $_SESSION["id"];
        $query = "SELECT requests.id , requests.created_at , requests.date_from , requests.date_to, requests.reason,
        requests.status, users.firstname , users.lastname  FROM requests JOIN users WHERE requests.user_id = users.id AND requests.user_id = (?)";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
        // free up resources        
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }     
}   