<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@400;700&display=swap" rel="stylesheet">
	<style>
  *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
   font-family: helvetica;
  }
table {
	width: 750px;
	border-collapse: collapse;
	margin:50px auto;
	}

/* Zebra striping */
tr:nth-of-type(odd) {
	background: #eee;
	}

th {
	background: #3498db;
	color: white;
	font-weight: bold;
	}

td, th {
	padding: 10px;
	border: 1px solid #ccc;
	text-align: left;
	font-size: 18px;
	}
  .approvebtn{
    border-radius: 50px;
    background: #01bf71;
    white-space: nowrap;
    padding: 10px 22px;
    color: #010606;
    font-size: 16px; 
    outline: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    text-decoration: none;

  }
  .rejectbtn{
    border-radius: 50px;
    background: red;
    white-space: nowrap;
    padding: 10px 32px;
    color: #010606;
    font-size: 16px; 
     outline: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
    text-decoration: none;
    margin-top: 5px;
  }
/*
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table {
	  	width: 100%;
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr {
		display: block;
	}

	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}

	tr { border: 1px solid #ccc; }

	td {
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee;
		position: relative;
		padding-left: 50%;
	}

	td:before {
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%;
		padding-right: 10px;
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}


}
</style>
</head>
  <body>
  <?php       session_start(); ?>
  <?php

    $regno = $_SESSION['employeeid'];

  include 'header.php';?>
    
    <?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

      $sql="SELECT * FROM leave_apply;";
        // $sql="SELECT regno,name,email,phoneno,block,roomno FROM users WHERE ";
      $query=mysqli_query($conn,$sql);
      if(array_key_exists('approve', $_POST)) {
          approve();
      }
      else if(array_key_exists('reject', $_POST)) {
          reject();
      }
      function approve() {
        $conn= mysqli_connect('localhost','root','','hms') or die("Connection failed:" .mysqli_connect_error());
        $regno1=$_POST['id'];
        $sql1="UPDATE `leave_apply` SET `status`='approved' where regno='$regno1'";
        $query1=mysqli_query($conn,$sql1);
        if($query1){
          echo 'successful';
        }
        else{
          echo "error occoured";
        }
        }
      function reject() {
        $conn= mysqli_connect('localhost','root','','hms') or die("Connection failed:" .mysqli_connect_error());
        $regno1=$_POST['id'];
        echo $regno1;
        $sql1="UPDATE `leaverequests` SET `status`='rejected' where regno='$regno1'";
        $query1=mysqli_query($conn,$sql1);
        if($query1){
          echo '<script>alert("successful")</script>';

        }
        else{
          echo "error occoured";
        }
      }

     ?>
     <?php

   ?>
    <form class="" action="leaverequests.php" method="post">


  <table>
  <thead>
    <tr>
      <th>Reg No</th>
      <th>Name</th>
      <th>Block</th>
      <th>Room No</th>
      <th>From Date</th>
      <th>To Date</th>
      <th>Reason</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($rows=mysqli_fetch_assoc($query))
    {
    ?>
    <tr> <td><?php echo $rows['regno']; ?></td>
    <td><?php echo $rows['name']; ?></td>
    <td><?php echo $rows['block']; ?></td>
    <td><?php echo $rows['roomno']; ?></td>
      <td><?php echo $rows['fromdate']; ?></td>
        <td><?php echo $rows['todate']; ?></td>
        <td><?php echo $rows['reason']; ?></td>

        <?php
        if($rows['status']==NULL){
         ?>
        <td>
          <input type="submit" name="approve" class="approvebtn" value="Approve">
          <input type="submit" name="reject" class="rejectbtn" value="Reject">
          <input type="hidden" name="id" value="<?php echo $rows['regno']; ?>"/>
        </td>
        <?php
}else{
         ?>
<td><?php echo $rows['status']; ?></td>

<?php } ?>
    </tr>
  <?php
               }
          ?>

  </tbody>
</table>

  </form>
  <div class=" rounded-md pl-[750px]">
    <div>
      <a href="../sample1.html"><button class="mb-[20px] w-[200px] rounded-md bg-[#1d77f5] py-[8px] text-[14px] font-semibold text-white shadow-[0px_0px_0px_2px_rgba(25,113,238,1),inset_0px_1px_1px_0px_rgba(255,255,255,0.3)] [text-shadow:_0_1px_0_rgb(0_0_0_/_20%)]">send link</button></a>
    </div>
</div>
<div class=" rounded-md pl-[750px]">
    <div>
      <a href="../sample.html"><button class="mb-[20px] w-[200px] rounded-md bg-[#1d77f5] py-[8px] text-[14px] font-semibold text-white shadow-[0px_0px_0px_2px_rgba(25,113,238,1),inset_0px_1px_1px_0px_rgba(255,255,255,0.3)] [text-shadow:_0_1px_0_rgb(0_0_0_/_20%)]">receive</button></a>
    </div>
</div>
  </body>
</html>
<script src="https://cdn.tailwindcss.com"></script>

