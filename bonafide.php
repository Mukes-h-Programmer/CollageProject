<?php


session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !=true){
    header("location: bonafide.php");
}

if(isset($_POST['submit'])){
    $font = "TIMESR.ttf";
    $image = imagecreatefromjpeg("BONAFIDE.jpg");

    $color = imagecolorallocate($image , 19, 21, 22);
    $name = $_POST['uname'];
    $fname = $_POST['fname'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $branch = $_POST['branch'];
    $clsrollno = $_POST['clsrollno'];
    $sesion = $_POST['sesion'];
    $fees = $_POST['fees'];
    $bankname = $_POST['bankname'];
    $bankno = $_POST['bankno'];
    $ifsc = $_POST['ifsc'];

    imagettftext($image, 25, 0, 670, 670, $color, $font, $name);
    imagettftext($image, 25, 0, 300, 725, $color, $font, $fname);
    imagettftext($image, 25, 0, 900, 725, $color, $font, $year);
    imagettftext($image, 20, 0, 980, 425, $color, $font, $date);
    imagettftext($image, 25, 0, 350, 827, $color, $font, $branch);
    imagettftext($image, 24, 0, 538, 825, $color, $font, $clsrollno);
    imagettftext($image, 20, 0, 890, 825, $color, $font, $sesion);
    imagettftext($image, 20, 0, 500, 1100, $color, $font, $fees);
    imagettftext($image, 20, 0, 280, 1405, $color, $font, $bankname);
    imagettftext($image, 20, 0, 430, 1445, $color, $font, $bankno);
    imagettftext($image, 20, 0, 270, 1486, $color, $font, $ifsc);



    imagejpeg($image,"Certificates/mukesh.jpg");


    $filename = "certificates/certificate_" . time() . ".png";
    imagepng($image, $filename);

    imagedestroy($image);
    

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
    <title>Bonfide Certificate</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="logout.php" tabindex="-1" aria-disabled="true">logout</a>
      </li>
    
    </ul>

     <div class = "navbar-collapse collapse">
        <ul class = "navbar-nav ml-auto">
        <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><img width="30" height="30" src="https://img.icons8.com/ios-glyphs/30/user--v1.png" alt="user--v1"/><?php echo "" . $_SESSION['username']?></a>
      </li>
</ul>
</div> 

  </div>
</nav>
<h2><p class="ttl"> Apply Form of Bonafide Certificate </p></h2>
<!-- <div class = "conatainer mt-4"  >
 <h3><?php echo "Welcome" . $_SESSION['username']?> You can now use this website</h3>
 <hr>

</div> -->

<?php

if(isset($_POST['submit'])){
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $year = $_POST['year'];
    $date = $_POST['date'];
    $branch = $_POST['branch'];
    $clsrollno = $_POST['clsrollno'];
    $sesion = $_POST['sesion'];
    $fees = $_POST['fees'];
    $bankname = $_POST['bankname'];
    $bankno = $_POST['bankno'];
    $ifsc = $_POST['ifsc'];
  $errrors = array();
  if(empty($uname) OR empty($fname) OR empty($year) OR empty($date) OR empty($branch) OR empty($clsrollno) OR empty($sesion) OR empty($fees) OR empty($bankname) OR empty($bankno) OR empty($ifsc)){
    array_push($errrors, "All fields are required");
  }

  if(count($errrors)>0){
    foreach($errrors as $errror){
      echo "<div class='alert alert-danger'>$errror</div>";
    }
  }else{
    //we will insert the data into database
    require_once "config.php";

    $sql = "INSERT INTO certificat (uname, fname, year, date, branch, clsrollno, sesion, fees, bankname, bankno, ifsc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt =  mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
     
    if($prepareStmt){
      mysqli_stmt_bind_param($stmt, "sssssssssss", $uname, $fname, $year, $date, $branch, $clsrollno, $sesion, $fees, $bankname, $bankno, $ifsc);
      mysqli_stmt_execute($stmt);
      echo "<div class='alrt1'>You Applied successfully.</div>";
    }else{
      die("Something went wrong");
    }

  }

}

?>

<form method="post" >
    
    <label for="username" class="lbl">Username<span class="required">* </span>:</label>
    <input type="text" name="uname" placeholder = "Enter your Name"/>

    <label for="username" class="lbl">Father's name<span class="required">* </span>:</label>
    <input type = "text" name="fname" placeholder = "Enter your father's name"/>

    <label for="username" class="lbl">Year<span class="required">*</span>:</label>
    <input type = "text" name="year" placeholder = "Enter your year of study"  />

    <label for="username" class="lbl">Date<span class="required">*</span>:</label>
    <input type="text"  name="date" placeholder = "Enter current date"/>

    <label for="username" class="lbl">Course<span class="required">*</span>:</label>
    <input type = "text"   name = "branch" placeholder = "Enter your course name"/> 

    <label for="username" class="lbl">Class roll no<span class="required">*</span>:</label>
    <input type = "text" name = "clsrollno" placeholder = "Enter your class roll number"/>

    <label for="username" class="lbl">Session<span class="required">*</span>:</label>
    <input type = "text" name="sesion" placeholder = "Enter your session year"  pattern="[A-Za-z0-9\s!@#$%^&*()]+" />

    <label for="username" class="lbl">Admission fees<span class="required">*</span>:</label>
    <input type = "text" name="fees" placeholder = "Enter your admission fees"  />

    <label for="username" class="lbl">Bank name<span class="required">*</span>:</label>
    <input type = "text" name="bankname" placeholder = "Enter your bank name"/>

    <label for="username" class="lbl">Bank A/c no<span class="required">*</span>:</label>
    <input type = "text" name="bankno" placeholder = "Enter your bank account number"/>

    <label for="username" class="lbl">Ifsc code<span class="required">*</span>:</label>
    <input type = "text" name = "ifsc" placeholder ="Enter your bank ifsc code"  pattern="[A-Za-z0-9\s!@#$%^&*()]+" />   
    
    <input type = "submit" name = "submit" value = " SUBMIT"/>
    
</form>

<?php
    // Display download link if a certificate was generated
    if(isset($_POST['submit'])){
      $uname = $_POST['uname'];
      $fname = $_POST['fname'];
      $year = $_POST['year'];
      $date = $_POST['date'];
      $branch = $_POST['branch'];
      $clsrollno = $_POST['clsrollno'];
      $sesion = $_POST['sesion'];
      $fees = $_POST['fees'];
      $bankname = $_POST['bankname'];
      $bankno = $_POST['bankno'];
      $ifsc = $_POST['ifsc'];
    $errrors = array();
    if(empty($uname) OR empty($fname) OR empty($year) OR empty($date) OR empty($branch) OR empty($clsrollno) OR empty($sesion) OR empty($fees) OR empty($bankname) OR empty($bankno) OR empty($ifsc)){
      array_push($errrors, "All fields are required");
    } 
    else{
        
      echo '<p><a  class="alrt2" href="' . $filename . '" download>Download Your Certificate</a></p>';
    }
            

    }
   
    ?>

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

