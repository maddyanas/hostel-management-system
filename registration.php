<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
     
   </head>
  <link rel="stylesheet" href="css\resgistration.css">
<body>
<?php
// Database connection
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "hms"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate password
function validatePassword($password) {
    // Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one special character
    if (preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^a-zA-Z0-9]).{8,}$/', $password)) {
        return true;
    } else {
        return false;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $regno = $_POST["regno"];
    $email = $_POST["email"];
    $phoneno = $_POST["phoneno"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $gender = $_POST["gender"];
    
    // Validate passwords
    if ($password !== $confirmpassword) {
        echo "<script>alert('Passwords do not match')</script>";
    } elseif (!validatePassword($password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one special character')</script>";
    } else {
        // Password is valid, proceed with database insertion
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // SQL to insert data into database
        $sql = "INSERT INTO users (name, regno, email, phoneno, password, gender)
                VALUES ('$name', '$regno', '$email', '$phoneno', '$password', '$gender')";
        
        if ($conn->query($sql) === TRUE) {
            
           echo "<script>alert('Registeration Successful')</script>";
        } else {
          $errmsg = "Error: " . $sql . "<br>" . $conn->error;
          echo "<script>alert('$errmsg')</script>";
        }
    }
    
}
?>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action=""   method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input name="name" type="text" placeholder="Enter your name" required pattern="[a-z A-Z]*">
          </div>
          <div class="input-box">
            <span class="details">Reg No</span>
            <input type="text" placeholder="Enter your regno" name="regno"  required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="text" placeholder="Enter your email" name="email"  required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phoneno" pattern="[0-9]{10}" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="confirmpassword" required>
          </div>

        </div>
        <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="male">
          <input type="radio" name="gender" id="dot-2" value="female">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>

          </div>
        </div>
        <div class="button">
          <input type="submit" value="Go Back" onclick="back()">
          <input type="submit" value="Register" name="submit" style="margin-left:85px;">
        </div>
       
      </form>
    </div>
  </div>
 
</body>
</html>
<script type="text/javascript">
       function back(){
         window.location.href ="index.php";
       }
      
     </script>
