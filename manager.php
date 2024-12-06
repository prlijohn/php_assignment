<?php  
    session_start();
    if(!empty($_SESSION["id"])){
      if($_SESSION["isManager"] == 0){
        header("Location: ./employee.php");
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

  <title>Manager Portal</title>

  <script>
    // JavaScript to handle edit button click
    function editUser(userId) {
        var row = document.querySelector('tr[data-id="' + userId + '"]');        
        // Extract the user data from the row
        var firstname = row.cells[1].innerText;
        var lastname = row.cells[2].innerText;
        var email = row.cells[3].innerText;        
        document.getElementById('userId').value = userId;
        document.getElementById('firstname').value = firstname;
        document.getElementById('lastname').value = lastname;
        document.getElementById('email').value = email;     
        document.getElementById('password').value = "";     
        document.getElementById('div-hidden').style.display = 'block';
    }
  </script>
 
</head>

<body>

<form class = "form-right" action="./handlers/logout_handler.php" method="post">
  <input type="submit" name="logout" value="logout">
</form>



<div id = "div-hidden" style="display:none;" class="container">
        <h2>Update User: </h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="./handlers/edit_user_handler.php" method="post">
                            <input type="hidden" id="userId" name="id">
                            <div class="form-group">
                                <label for="firstname">First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>                          
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>                            
                            <button class='btn' type='submit'>Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<h2>Users Table: </h2>
<?php 
  //echo $_SESSION["username"];
  require_once "./handlers/select_all_users_handler.php";
  require_once "./handlers/select_all_requests_handler.php";
  
  if(empty($users)){
    echo "<div>";
    echo "<h2> There are no Users! </h2>";
    echo "<div>";
  } else {
    echo "<div class='table-container testdiv'>";
    echo "<table class='table table-hover'>";
    echo  "<thead class='thead-light'>";
    echo    "<tr>";
    echo      "<th scope='col'>#</th>";
    echo      "<th scope='col'>First</th>";
    echo      "<th scope='col'>Last</th>";
    echo      "<th scope='col'>Email</th>";
    echo      "<th scope='col'>Employee Number</th>";
    echo      "<th scope='col'>Update</th>";
    echo      "<th scope='col'>Delete User</th>";
    echo    "</tr>";
    echo  "</thead>";
    echo  "<tbody>";
    
    foreach($users as $user){
    echo    "<tr data-id=" . htmlspecialchars($user["id"]) .">";
    echo      "<form action='./handlers/delete_user_handler.php' method='post'>";
    echo      "<th scope='row'>" . htmlspecialchars($user["id"]) .
              "<input type='hidden' name='id'value=". htmlspecialchars($user["id"]) ."></th>";
    echo      "<td>" . htmlspecialchars($user["firstname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($user["lastname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($user["email"]) . "</td>";
    echo      "<td>" . htmlspecialchars($user["empnumber"]) . "</td>";
    echo      "<td> <button type='button' onclick='editUser(". htmlspecialchars($user["id"]) ."); return false;'class='btn'>Edit</button></td>";
    echo      "<td> <button class='btn' type='submit'>Delete</button></td>";
    echo      "</form>";
    echo    "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  }?>
  <h2>Requests Table: </h2>
  <?php
  if(empty($requests)){
    echo "<div>";
    echo "<h2> There are currently no requests! </h2>";
    echo "<div>";
  }  else {
    //var_dump($requests);
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
    echo      "<th scope='col'>Save Changes</th>";
    echo    "</tr>";
    echo  "</thead>";
    echo  "<tbody>";
    
    foreach($requests as $request){
    echo      "<form action='./handlers/request_update_handler.php' method='post'>";
    echo    "<tr>";
    
    echo      "<th scope='row' name='id'>" . htmlspecialchars($request["id"]) . 
              "<input type='hidden' name='id'value=". htmlspecialchars($request["id"]) ."></th>";
    echo      "<td>" . htmlspecialchars($request["firstname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["lastname"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["date_from"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["date_to"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["created_at"]) . "</td>";
    echo      "<td>" . htmlspecialchars($request["reason"]) . "</td>";
    echo      "<td>";
    echo      "<select class='form-control' name='status'>";
    if($request["status"] == "PENDING"){
    echo  "<option value='PENDING' selected='selected'>PENDING </option>";
    echo  "<option value='APPROVED'>APPROVED </option>";    
    echo  "<option value='REJECTED' >REJECTED </option>";
    }else if($request["status"]=="REJECTED"){
      echo  "<option value='REJECTED' selected='selected'>REJECTED </option>";
      echo  "<option value='APPROVED'>APPROVED </option>";
      echo  "<option value='PENDING'>PENDING </option>";
      
    }else{
      echo  "<option value='APPROVED' selected='selected'>APPROVED </option>";
      echo  "<option value='PENDING'>PENDING </option>";
      echo  "<option value='REJECTED'>REJECTED </option>";
    }    
    echo "</select>";
    echo "</td>";
    echo "<td>";
    echo "<button class='btn' type='submit'>Submit</button>";
    
    echo "</td>";    
    
    echo    "</tr>";
    echo "</form>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
  }
?>

<h2>Create New User: </h2>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="./handlers/register_handler.php">
                            <div class="form-group">
                                <label for="firstname">Firstname: </label>
                                <input type="text" class="form-control" name="firstname" required />
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname: </label>
                                <input type="text" class="form-control" name="lastname" required />
                            </div>
                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input type="text" class="form-control" name="username" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email: </label>
                                <input type="text" class="form-control" name="email" required />
                            </div>
                            <div class="form-group">
                                <label for="empnumber">Employee Number: </label>
                                <input type="number" class="form-control" name="empnumber" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password: </label>
                                <input type="password" class="form-control" name="password" required />
                            </div>
                            <button class='btn' type='submit'>Submit</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

  

</body>
</html>

<?php 
  if(isset($_POST["logout"])){
    session_destroy();
    header("Location: login.php");
  }
?>