<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
    #htmlspecialchars is used for echoing data to the browser
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);   

    try {
        require_once "../includes/db.php";
        $query = "SELECT * FROM users WHERE username = (?) AND password = (?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username,$password]);
        $user = $stmt->fetch();
        var_dump($stmt);
        
        if($user){
            session_start();
            $_SESSION["id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["isManager"] = $user["isManager"];
            $_SESSION["error"] = "";

            if($_SESSION["isManager"]){
                header("Location: ../manager.php");
            }else{
                header("Location: ../employee.php");
            }            
            exit();
        }else{
            session_start();
            $_SESSION["error"] = "Incorrect Credentials";
            header("Location: ../employee.php");
            exit();
        }

    } catch (PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

}else{
    //Not a POST method used
    header("Location: ./index.php");
    exit();
}