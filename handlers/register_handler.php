<?php
session_start();
if(!empty($_SESSION["id"])){
    #Check if the user is an employee, only manager can register new user!
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

    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $empnumber = htmlspecialchars($_POST["empnumber"]);
    $password = htmlspecialchars($_POST["password"]);

    try {
        require_once "../includes/db.php";
        $query = "INSERT INTO users (username,password,email,firstname,lastname,empnumber) VALUES (?,?,?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username,$password,$email,$firstname,$lastname,$empnumber]);
        // free up resources
        var_dump($stmt);
        $pdo = null;
        $statement =  null;        
        header("Location: ../manager.php");
        exit(); 
               
    } catch (PDOException $e){
        die("Query failed: " .$e->getMessage());
    }

}else{
    //Not a POST method used
    header("Location: ../manager.php");
    exit();
}
