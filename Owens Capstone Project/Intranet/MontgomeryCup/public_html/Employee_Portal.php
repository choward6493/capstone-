<?php
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}
function alertJS($message, $with_script_tags = true){
$js_code = 'alert(' . json_encode($output, JSON_HEX_TAG) . 
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
$location="";
echo $location;
try{
$location=$_POST['location'];
setcookie("location",$location, time() + (86400/24), "/");
          
}catch(Exception $e){

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
        $hashedData=$result2->fetch_array();
        //echo '<br>'.$hashedData.'<br>';
        //echo '<br>'.$hashPass;
        if($hashPass==$hashedData["PasswordHash"]){
          //get employee name
            $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
            $result = $conn->query($sql);
            $employeeName=$result->fetch_assoc()["FirstName"];
            //get employee title
            $sql = 'SELECT * FROM Employees WHERE EmployeeID='.$userID;
            $result = $conn->query($sql);
            $employeeTitle=$result->fetch_assoc()["Title"];
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
if(!$loggedIn){
  echo "<script>window.location.replace('/');</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head><title>Montgomery Cup Coffee</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="index.css">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->
</head>
<body>
<div id="wrapper">
<div class="toplink">
   <a href="index.php">Home</a>
   <a href="order.php">New order</a>
   <a href="#">Employee Portal</a>
</div>
 <article>
    <div class="portal">
       <div class="row">
       <?php
 if($employeeTitle=="Manager" || $employeeTitle=="Owner"){
  echo '<div class="column">
  <div class="content">
<a href="manage.php">
    <img src="images/adp.png" alt="Manager" style="width:100%">
  </a>
    <h3>Manager Functions</h3>
  </div>
</div>';
 }
 
 ?>
  
  <div class="column">
    <div class="content">
    <a href="files/">
      <img src="images/Profile.png" alt="trainning" style="width:100%">
    </a>
      <h3>Files</h3>
    </div>
  </div>
  <div class="column">
    <div class="content">
    <a href="trainings/">
      <img src="images/trainning.png" alt="trainning" style="width:100%">
    </a>
      <h3>Trainings</h3>
    </div>
  </div>
  
</div> 
    </div>
</article>
</div>
<script>


var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>


