<?php

require_once "config.php";

$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
// Check if username is empty


if(empty(trim($_POST["username"]))){


    $username_err = "Username cannot be blank";
}
else{
    $sql  = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        //Set the value of param username
        $param_username = trim($_POST['username']);

        //Try to execute this statement

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt)==1){
                $username_err = "This username is already taken";
            }
            else{
                $username = trim($_POST['username']);
            }
        }
        else{
            echo "Something went wrong";
        }
    }
}
// mysqli_stmt_close($stmt);



// Check for password 

if(empty(trim($_POST['password']))){
  $password_err = "password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
  $password_err = "Password cannot be less than 5 characters";
}
else{
  $password = trim($_POST['password']);
}


// check for confirm password field

if(trim($_POST['password']) != trim($_POST['confirm_password'])){
    $password_err = "password should match";
}

// If there were no errors , go ahead and insert into the database

if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
  
  $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if($stmt){
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        //Try to execute the query
        if(mysqli_stmt_execute($stmt)){
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirecet!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type = "text/css" href="styles.css">
    <title>Registeration</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
     
    
    </ul>
  </div>
</nav>


<div class = "conatainer mt-4 "  >
 <h3 class="register"> Please register here</h3>
 <hr>

 <?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if(empty($username) OR empty($password) OR empty($confirm_password)){
    echo'<p class="alert1"> All fields are required! </p>';

  }
  elseif(trim($password) != trim($confirm_password)){
    echo'<p class="alert1"> Password must match! </p>';

  }
}
?>

<form action="" method="post" class="rform" >
  <div class="form-columns ms"> 
  <div class="form-group col-md-6 ">
      <label class = "l" for="inputEmail4">Registeration no<span class="required">*</span>:</label>
      <input type="text" class="form-control usr" name = "username" id="inputEmail4" placeholder="Univ. reg. no">
    </div>
    <div class="form-group col-md-6 ">
      <label class = "l" for="inputPassword4">Password<span class="required">*</span>:</label>
      <input type="password" class="form-control ps" name = "password" id="inputPassword4" placeholder="Password">
    </div>

  <div class="form-group col-md-6 ">
      <label class = "l" for="inputPassword4">Confrim Password<span class="required">*</span>:</label>
      <input type="password" class="form-control cps" name = "confirm_password" id="inputPassword4" placeholder="Password">
    </div>
  </div>
    

  <button type="submit" class="btn btnn btn-primary">Sign up</button>
</form>

</div>

<!-- footer open -->

<footer>
    <div class="footer-content">
      <div class="footer-section about">
        <h2>About Us</h2>
        <p>Jamshedpur Co-operative College is a symbol of the painstaking efforts of Late M. D. Madan</p>
      </div>

      <div class="footer-section links">
        <h2>Quick Links</h2>
        <ul>
          
          <li><a href="#">About</a></li>
          <li><a href="#">Admissions</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <div class="footer-section contact">
        <h2>Contact Us</h2>
        <p>Email: cooperativecollegejsr@gmail.com</p>
        <p>Phone: 10657-2228176</p>
      </div>
    </div>

    <div class="footer-bottom">
      &copy; 2023 Jamshedpur Co-operative College. All rights reserved.
    </div>
    <script src="script.js"></script>
  </footer>



  <!-- footer close -->
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

