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
$message=$_POST['message'];
if(!is_null($message)){
  echo '<script>alert("'.$message.'");</script>';
}
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
  <script>
      var screenSwitch=function(screenNum){
        if(screenNum==0){
          document.getElementById('newEmployee').style.display='none';
          document.getElementById('editEmployee').style.display='block';
        }else if(screenNum==1){
          document.getElementById('newEmployee').style.display='block';
          document.getElementById('editEmployee').style.display='none';
        }
      }
</script>
  <a href="javascript:screenSwitch(1);">New Employee</a>
 <a  href="javascript:screenSwitch(0);">Edit Employees</a>
  <article>
    <div class="portal" id="editEmployee"style="display:none" >
    <script>
    var addToForm=function(formI,nameI,valueI){
      var x=document.getElementById(formI);
      var inputt=document.createElement("input");
      inputt.value=valueI;
      inputt.name=nameI;
      x.add(inputt);
    }
    </script>
    <form method="POST" id="editEmpForm"></form>
      <table>
        <tr>
          <th>Employee Name</th>
          <th>Employee Status</th>
          <th>Employee Title</th>
        </tr>
      <?php 
      $sql='SELECT * FROM Employees';
      $result=$conn->query($sql);
      $employees=$result->fetch_all(MYSQLI_ASSOC);
      console_log($employees);
      console_log();
      for($i=0;$i<count($employees);$i++){
        echo '';
        echo '<tr><th>'.$employees[i]["FirstName"].' '.$employees[i]["LastName"].' - </th>';
        echo '<th><select id="empStatus'.$i.'">
                  <option value="Active"'.($employees[i]["Status"]=="Active" ?'required':' ').'>Active</option>
                  <option value="Inactive"'.($employees[i]["Status"]=="Inactive" ?'required':' ').'>Inactive</option>
                  <option value="Quit"'.($employees[i]["Status"]=="Quit" ?'required':' ').'>Quit</option>
                  <option value="Fired"'.($employees[i]["Status"]=="Fired" ?'required':' ').'>Fired</option>
                  </select></th>';
        echo '<script>
        document.getElementById("empStatus'.$i.'").onchange=function(){
          var form = document.createElement("form");
          var element1 = document.createElement("input");
          var element2 = document.createElement("input");
          form.method = "POST";
          form.action = "#";   
          element1.value=document.getElementById("empStatus'.$i.'").value;;
          element1.name="empStatus";
          element2.value="'.$employees[i]['EmployeeID'].'";
          element2.name="empID";
          form.appendChild(element1);
          document.body.appendChild(form);
          form.submit();
        }
        </script>';
        echo '<th>'.$employees[$i]["Title"].'</th></tr>';
      }
      ?>
  </div>
    <div class="portal" id="newEmployee" style="display:none">
       <div class="row">
        <h2>Add an Employee</h2>
        <br>
          <div class="inputfield">
            <form action="newUser.php" method="post" id="new_employee">
              
              <div>
                <br>
                <label for="fname">First Name:</label><br>
                <input type="text" name="fname" id="fname" placeholder="Enter employee First name">
              </div>
                <div>
                <label for="lname">Last Name:</label><br>
                <input type="text" name="lname" id="lname" placeholder="Enter employee Last name" required>
              </div>
              <div>
                <label for="phone_number">Phone Number:</label><br>
                <input type="text" name="phone_number" id="phone_number" placeholder="Enter employee phone number"required>
              </div>
                <div>
                <label for="email">Email: </label><br>
                <input type="email" name="email" id="email" placeholder="Enter employee email"required>
              </div>
                <div>
                <label for="hire_date">Hire date:</label><br>
                <input type="date" name="hire_date" id="hire_date" placeholder="Enter employee hire date"required>
              </div>
              <div>
                <label for="dob">Date of Birth:</label><br>
                <input type="date" name="dob" id="dob" placeholder="Enter employee DOB"required>
              </div>
              <div>
                <label for="ssn">SSN:</label><br>
                <input type="password" name="ssn" id="ssn" placeholder="Enter employee social security number"required>
              </div>
                <div>
                <label for="street_address">Street Address:</label><br>
                <input type="text" name="street_address" id="street_address" placeholder="Enter employee address"required>
              </div>
              <div>
                <label for="apt_number">Apartment Number (if applicable):</label><br>
                <input type="text" name="apt_number" id="apt_number" placeholder="Enter employee apartment number">
              </div>
                <div>
                <label for="city">City</label><br>
                <input type="text" name="city" id="city" placeholder="Enter employee city"required>
              </div>
              <div>
                <label for="state">State</label><br>
                <input type="text" name="state" id="state" placeholder="Enter employee state"required>
              </div>
                <div>
                <label for="zip_code">ZIP Code:</label><br>
                <input type="text" name="zip_code" id="zip_code" placeholder="Enter employee zip code"required>
              </div>
            <br><br>
              <div>
                <label for="empPass">Enter a new employee password:</label><br>
                <input type="password" name="empPass" id="empPass" placeholder="Enter a new employee password"required>
              </div>
              <br>
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


