<?php
//This script will handle login

session_start();

// check if the user is already logged in 
if(isset($_SESSION['username'])){
  header("location: welcome.php");
  exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))){
      $err = "Please enter username + password";
    }
    else{
      $username = trim($_POST['username']);
      $password = trim($_POST['password']);
    }


if(empty($err)){
  $sql = "SELECT id, username, password FROM users WHERE username = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $param_username);
  $param_username = $username;

   //Try to execute this statement

   if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt)==1){

      mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
      if(mysqli_stmt_fetch($stmt)){
        if(password_verify($password, $hashed_password)){
          // this means the password is correct. Allow user to login
          session_start();
          $_SESSION['username'] = $username;
          $_SESSION['id'] = $id;
          $_SESSION['loggedin'] = true;

          //Redirect  user to welcome page

          header("location: welcome.php");

        }
      }
  }
   }
}

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
    <title>Login</title>
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

<div class = "conatainer mt-4"  >
 <h3 class="register"> Please login here</h3>
 <hr>
<div class="clg" style = "margin: 0px 0px 0px 550px">
<img  src="clg.png" height= "150px" >
</div>
 

  <?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    echo '<p class="alert1"> All fields are required. </p>';
} else {
    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];  // Fetch the hashed password

        if (password_verify($password, $hashed_password)) {
          echo '<p class="alert1"> Username found. </p>';
            // Password is correct
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $row['id'];
            $_SESSION['loggedin'] = true;

            header("location: welcome.php");
            exit;
        } else {
            echo '<p class="alert1"> Incorrect username or password!</p>';
        }
    } else {
        echo '<p class="alert1"> Incorrect username or password! </p>';
    }
}
}

?> 

 <form action="" method = "post" class="rform">
  <div class="form-columns ms">
  <div class="form-group col-md-6">
    <label class = "l" for="inputEmail4">Registeration no<span class="required">*</span>:</label>
    <input type="text" name = "username" class="form-control usr" id="inputEmail4"  placeholder="Enter univ. reg. no">
  </div>
  <div class="form-group col-md-6">
    <label class = "l" for="inputPassword4">Password<span class="required">*</span>:</label>
    <input type="password"  name = "password" class="form-control ps" id="inputPassword4" placeholder="Enter Password">
  </div>
</div>
  
  <button type="submit" class="btn btnn btn-primary">Sign in</button>
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

