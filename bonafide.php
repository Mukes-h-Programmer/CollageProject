<?php

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
    $session = $_POST['session'];
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
    imagettftext($image, 20, 0, 890, 825, $color, $font, $session);
    imagettftext($image, 20, 0, 500, 1100, $color, $font, $fees);
    imagettftext($image, 20, 0, 280, 1405, $color, $font, $bankname);
    imagettftext($image, 20, 0, 430, 1445, $color, $font, $bankno);
    imagettftext($image, 20, 0, 270, 1486, $color, $font, $ifsc);










    imagejpeg($image,"Certificates/mukesh.jpg");
    imagedestroy($image);
    echo "Certificate Created";






}

?>

<form method="post">
    <input type="text" name="uname" placeholder = "Enter your Name"/>
    <input type = "text" name="fname" placeholder = "Enter your father's name"/>
    <input type = "text" name = "year" placeholder = "Enter your year of study" pattern="[A-Za-z0-9\s!@#$%^&*()]+" />
    <label for="dateInput">Select a date:</label>
    <input type="date"  name="date">
    <input type = "text"   name = "branch" placeholder = "Enter your course name"/>
    <input type = "number" name = "clsrollno" placeholder = "Enter your class roll number"/>
    <input type = "text" name="session" placeholder = "Enter your session year"  pattern="[A-Za-z0-9\s!@#$%^&*()]+" />
    <input type = "number" name="fees" placeholder = "Enter your admission fees"  />
    <input type = "text" name="bankname" placeholder = "Enter your bank name"/>
    <input type = "number" name="bankno" placeholder = "Enter your bank account number"/>
    <input type = "text" name = "ifsc" placeholder ="Enter your bank ifsc code"  pattern="[A-Za-z0-9\s!@#$%^&*()]+" />   
    <input type = "submit" name = "submit" value = "GENERATE"/>
    
</form>