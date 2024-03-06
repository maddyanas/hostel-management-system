<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="applyleave.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <script type="text/javascript">

    function goback(){
        window.location.href ="studentdashboard.php";
    }
  </script>
<link rel="stylesheet" href="..\css\applyleave.css">

<body>
  
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form action="" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" pattern="[a-z A-Z]*" name="name" required >
          </div>
          <div class="input-box">
            <span class="details">Reg No</span>
            <input type="text" placeholder="Enter your regno" name="regno" required>
          </div>
          <div class="input-box">
            <span class="details">Department</span>
            <input type="text" placeholder="Enter your block name" name="dept"  required>
          </div>
          <div class="input-box">
            <span class="details">From</span>
            <input type="date" name="fromdate" id="fromdate" placeholder="Enter from date " required>
          </div>
          <div class="input-box">
            <span class="details">To</span>
            <input type="date" name="todate" id="todate" placeholder="Enter to date"  required>
          </div>
          

        <div class="button">
          <input type="button" value="Go Back" onclick="goback()"><br>
          <input type="submit" name="submit" style="margin-left:170px;" >
        </div>
      </form>
      <span style="color: red;"></span>
        <span style="color: green;"></span>
    </div>
  </div>

  <?php
// Retrieving form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Assuming other variables like $name, $regno, $block, $roomno are already defined
  $name = $_POST['name']; // Assuming 'name' is the input name attribute for full name
  $regno = $_POST['regno']; // Assuming 'regno' is the input name attribute for registration number
  $dept = $_POST['dept']; // Assuming 'block' is the input name attribute for block name
  $fromdate = $_POST['fromdate'];
  $todate = $_POST['todate'];

  // Assuming your database connection details
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hms";

  // Establishing a connection to the database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Constructing the SQL query
  $sql = "INSERT INTO guest(name, regno, dept, fromdate, todate) 
          VALUES ('$name', '$regno', '$dept', '$fromdate', '$todate')";

  // Executing the SQL query
  if ($conn->query($sql) === TRUE) {
     echo "<script>alert('Your request has been submitted !!')</script>";
  } else {
      $errmsg = "Error: " . $sql . "<br>" . $conn->error;
  }

  // Closing the database connection
  $conn->close();
}
?>


</body>
</html>
