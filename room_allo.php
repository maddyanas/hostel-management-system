<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Expanded:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: helvetica;
        }
        table {
            width: 750px;
            border-collapse: collapse;
            margin: 50px auto;
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
        .approvebtn {
            border-radius: 50px;
            background: #01bf71;
            whitespace: nowrap;
            padding: 10px 22px;
            color: #010606;
            font-size: 16px;
            outline: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
        }
        .rejectbtn {
            border-radius: 50px;
            background: red;
            whitespace: nowrap;
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
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            table {
                width: 100%;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr { border: 1px solid #ccc; }
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }
            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-column);
                color: #000;
                font-weight: bold;
            }
        }
   
    </style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users;";
$query = mysqli_query($conn, $sql);

if(isset($_POST['approve'])) {
    /*$regno1 = $_POST['id'];
    $roomno = $_POST['roomno'];
    $sql1 = "UPDATE users SET roomno='$roomno' WHERE regno='$regno1'";
    $query1 = mysqli_query($conn, $sql1);*/
    if($query1) {
        echo '<script>alert("Successful")</script>';
    } else {
        echo '<script>alert("Error occurred")</script>';
    }
}
?>
<form action="" method="post">
    <table>
        <thead>
            <tr>
                <th>Reg No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Gender</th>
                <th>Block</th>
                <th>Room Sharing</th>
                <th>Room No</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($rows = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $rows['regno']; ?></td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td><?php echo $rows['phoneno']; ?></td>
                <td><?php echo $rows['gender']; ?></td>
                <td><?php echo $rows['block']; ?></td>
                <td><?php echo $rows['roomsharing']; ?></td>
                <?php if($rows['roomno'] == 1) { ?>
                <td>
                    <input type="hidden" name="id" value="<?php echo $rows['regno']; ?>">
                </td>
                <?php } else { ?>
                <td><?php echo $rows['roomno']; ?></td>
                <<td>
                    <input type="submit" name="approve" class="approvebtn" value="Accept">
                    <input type="submit" name="decline" class="rejectbtn" value="Decline">
                </td>
                <?php } ?>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hms";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM users;";
$query = mysqli_query($conn, $sql);

if(isset($_POST['approve'])) {
    $regno1 = $_POST['id'];
    $roomno = $_POST['roomno'];
    $sql1 = "UPDATE users SET roomno='$roomno' WHERE regno='$regno1'";
    $query1 = mysqli_query($conn, $sql1);
    if($query1) {
        $status = "approved";
        $sql_update = "UPDATE users SET action='$status' WHERE regno='$regno1'";
        mysqli_query($conn, $sql_update);
        echo '<script>alert("Successful")</script>';
    } else {
        echo '<script>alert("Error occurred")</script>';
    }
}

if(isset($_POST['decline'])) {
    $regno1 = $_POST['id']; // Change 'email' to 'id'
    $status = "declined";
    $sql_update = "UPDATE users SET action='$status' WHERE regno='$regno1'";
    $query_update = mysqli_query($conn, $sql_update);
    if($query_update) {
        echo '<script>alert("Successful")</script>';
    } else {
        echo '<script>alert("Error occurred")</script>';
    }
}
?>

</body>
</html>
