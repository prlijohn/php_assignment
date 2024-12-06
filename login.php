<?php 
    session_start();
    if(!empty($_SESSION["id"])){
        header("Location: ./employee.php");
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

  <title>Login Page</title>
 
</head>

<body>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="./handlers/login_handler.php">
                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input type="username" class="form-control" name="username" required />
                            </div>
                            <div class="form-group">
                                <label for="password"> Password: </label>
                                <input type="password" class="form-control" name="password" required />
                            </div>
                            <input class="btn" type="submit" name="login" value="login">
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if(!empty($_SESSION["error"])){
            echo "<h2> " .$_SESSION["error"]. "</h2>";
        }
    ?>
</body>
</html>