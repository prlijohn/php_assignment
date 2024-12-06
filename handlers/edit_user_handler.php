<?php

session_start();
if(!empty($_SESSION["id"])){
//only managers can execute this query
  if($_SESSION["isManager"] == 0){
    header("Location: ../employee.php");
    exit();
  }       
}else{
  header("Location: ../login.php");
  exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {    
        require_once "../includes/db.php";
        $id = htmlspecialchars($_POST["id"]);
        $firstname = htmlspecialchars($_POST["firstname"]);
        $lastname = htmlspecialchars($_POST["lastname"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        $query = "UPDATE users SET firstname = (?), lastname = (?), email= (?) , password=(?) WHERE id = (?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$firstname,$lastname,$email,$password,$id]);
        // free up resources
        var_dump($statement);
        $pdo = null;
        $statement =  null;
        header("Location: ../manager.php");
        exit();
    } catch (PDOException $e){    
        echo  $e.getMessage();
    }

}else{
    //Not a POST method used
    header("Location: ./index.php");
    exit();
}