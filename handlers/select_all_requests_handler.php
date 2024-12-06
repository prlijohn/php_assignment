<?php

//session_start();
if(!empty($_SESSION["id"])){
    #Check if the user is an employee
    if($_SESSION["isManager"] == 0){
        header("Location: ./employee.php");
        exit();
    }    
}else{
    #User has not logged in!
    header("Location: ./login.php");
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "GET") {

        
        require_once "./includes/db.php";
        $query = "SELECT requests.id , requests.created_at , requests.date_from , requests.date_to, requests.reason,
        requests.status, users.firstname , users.lastname  FROM requests JOIN users WHERE requests.user_id = users.id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        // free up resources        
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($requests);
        //echo $users;
        if (!$requests) {
            echo "No requests found or error with database.";
            exit;
        }      

}
    