<?php  
    session_start();
    if(!empty($_SESSION["id"])){
      if($_SESSION["isManager"] == 1){
        header("Location: ./manager.php");
        exit();
      }       
    }else{
      header("Location: ./login.php");
      exit();
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./css/style.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Employee portal</title>
 
</head>

<body>

<!--Logout Button -->
<form class = "form-right" action="./handlers/logout_handler.php" method="post">
  <input type="submit" name="logout" value="logout">
</form>

<!-- All my Requests -->

<h2>My Requests Table: </h2>
<?php 
  //echo $_SESSION["username"];
  require_once "./handlers/requests_employee_handler.php";

if(empty($requests)){
    echo "<div>";
    echo "<br><h2> There are currently no requests! </h2><br>";
    echo "<div>";
  } else {
    echo "<div class='table-container testdiv'>";
    echo "<table class='table table-hover'>";
    echo  "<thead class='thead-light'>";
    echo    "<tr>";
    echo      "<th scope='col'>#</th>";
    echo      "<th scope='col'>Firstname</th>";
    echo      "<th scope='col'>Lastname</th>";
    echo      "<th scope='col'>From</th>";
    echo      "<th scope='col'>To</th>";
    echo      "<th scope='col'>Created_at</th>";
    echo      "<th scope='col'>Reason</th>";
    echo      "<th scope='col'>Status</th>";
    echo      "<th scope='col'>Action</th>";
    echo    "</tr>";
    echo  "</thead>";
    echo  "<tbody>";

    foreach($requests as $request){

    echo    "<tr>";
    echo      "<form action='./handlers/delete_request_handler.php' method='post'>";
    echo      "<th scope='row'>" . htmlspecialchars($request["id"]) .
              "<input type='hidden' name='id'value=". htmlspecialchars($request["id"]) ."></th>";
    echo      "<td>" . htmlspecialchars($request["firstname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["lastname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["date_from"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["date_to"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["created_at"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["reason"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["status"]) . "</td>";

    if($request["status"] == "PENDING"){
    echo      "<td> <button class='btn' type='submit'>Delete</button></td>";    
    }    
    
    echo      "</form>";
    echo    "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  }?>

<!--Create New Requests -->
<h2>New request: </h2>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="./handlers/create_request_handler.php">
                            <div class="form-group">
                                <label for="from">Select Date From:</label>
                                <input type="date" name="from">
                            </div>
                            <div class="form-group">
                                <label for="to">Select Date To:</label>
                                <input type="date" name="to"> 
                            </div>
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <input type="text" name="reason">     
                            </div>
                            <button type="submit">Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>