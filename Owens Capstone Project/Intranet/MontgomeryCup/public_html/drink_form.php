<?php
//need handling to make sure user is logged in
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
$servername = "capstone.cfwnz1g6jqbd.us-east-1.rds.amazonaws.com:3306";
$username = "admin";
$password = "SixGuys1CapstoneProject";
$dbname="Capstone";
$loggedIn=false;
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_COOKIE['token'])&&isset($_COOKIE['user'])){
  $usernamePP=$_COOKIE['user'];
  //console_log($usernamePP);
  $hashPass=$_COOKIE['token'];
  $userID=0;
  $sql = 'SELECT EmployeeID FROM Employees WHERE Email="'.$usernamePP.'"';
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      // output userID from email
      $userID=$result->fetch_assoc()["EmployeeID"];
      //echo $result->fetch_assoc()["CustomerID"].'<br>';
      $sql2 = 'SELECT PasswordHash FROM EmployeeLOG WHERE EmployeeID='.$userID;
      //echo $sql2;
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0) {
          // output userID from email
          $hashedData=$result2->fetch_assoc()["PasswordHash"];
          //echo '<br>'.$hashedData.'<br>';
          //echo '<br>'.$hashPass;
          if($hashPass==$hashedData){
              $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
              $result = $conn->query($sql);
              $employeeName=$result->fetch_assoc()["FirstName"];
              $loggedIn=true;
              //echo 'test';

          }else {
              //echo "Password not right";
          }
      } else {
        //echo "nothing found";
      }
  } else {
      //echo "0 results";

  }
}else{
  $loggedIn=false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Montgomery Cup Coffee</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div id="wrapper">
        <div class="toplink">
        <a href="index.php">Home</a>
         <a href="order.php">New order</a>
         <a href="Employee_Portal.php">Employee Portal</a>
       </div>
        
   

</div>
<script>
        
</script>

</body>
</html>