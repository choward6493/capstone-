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
<head>
<title>Montgomery Cup Coffee</title>
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
       <h2>Add an Employee</h2>
     <div class="inputfield">
     <form action="/newUser.php" method="post" id="new_employee">
  
	<h4>Employee Personal Infos</h4>
  <div>
    <label for="ssn"></label><br>
    <input type="text" name="ssn" id="ssn" placeholder="Enter employee social security number">
  </div>
    <div>
    <label for="street_address"></label><br>
    <input type="text" name="street_address" id="street_address" placeholder="Enter employee street address">
  </div>
  <div>
    <label for="apt_number"></label><br>
    <input type="text" name="apt_number" id="apt_number" placeholder="Enter employee apt number">
  </div>
    <div>
    <label for="city"></label><br>
    <input type="text" name="city" id="city" placeholder="Enter employee city">
  </div>
  <div>
    <label for="state"></label><br>
    <input type="text" name="state" id="state" placeholder="Enter employee state">
  </div>
    <div>
    <label for="zip_code"></label><br>
    <input type="text" name="zip_code" id="zip_code" placeholder="Enter employee zip code">
  </div>

	<legend>Employee General Infos</legend>
  <div>
    <label for="fname"></label><br>
    <input type="text" name="fname" id="fname" placeholder="Enter employee firstt name">
  </div>
    <div>
    <label for="lname"></label><br>
    <input type="text" name="lname" id="lname" placeholder="Enter employee last name">
  </div>
  <div>
    <label for="phone_number"></label><br>
    <input type="text" name="phone_number" id="phone_number" placeholder="Enter employee phone number">
  </div>
    <div>
    <label for="email"></label><br>
    <input type="text" name="email" id="email" placeholder="Enter employee email">
  </div>
  <div>
    <label for="status"></label><br>
    <input type="text" name="status" id="status" placeholder="Enter employee status">
  </div>
    <div>
    <label for="hire_date"></label><br>
    <input type="text" name="hire_date" id="hire_date" placeholder="Enter employee hire_date">
  </div>
    <div>
    <label for="title"></label><br>
    <input type="text" name="title" id="title" placeholder="Enter employee status">
  </div>
<button type="submit" form="new_employee">Add New Employee</button>
</form>
  <!--
  <div class="column">
    <div class="content">
    <a href="files/">
      <img src="images/trainning.png" alt="trainning" style="width:100%">
    </a>
      <h3>Trainings</h3>
    </div>
  </div>
  -->
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


