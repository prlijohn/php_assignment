<?php
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

    try {    
        require_once "./includes/db.php";        
        $query = "SELECT * FROM users";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        // free up resources        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        #echo $users;
        if (!$users) {
            echo "No users found or error with database.";
            exit();
        }
        
        
    }catch (PDOException $e){    
        echo  $e.getMessage();
    }

}