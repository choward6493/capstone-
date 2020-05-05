<?php 
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
$fname=$_POST["fname"];
$lname=$_POST["lname"];
$phoneNumber=$_POST["phoneNumber"];
$email=$_POST["email"];
$ssn=$_POST["ssn"];
$address=$_POST["street_address"];
$aptNumber=$_POST["apt_number"];
$city=$_POST["city"];
$state=$_POST["state"];
$zipCode=$_POST["zip_code"];
$hireDate=$_POST["hire_date"];
$dob=$_POST["dob"];
$empPass=$_POST["empPass"];

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
  }

if($loggedIn){
    $sql='INSERT INTO Employees(FirstName,LastName,PhoneNumber,Email,HireDate,Status,Title)Values("'.$fname.'","'.$lname.'","'.$phoneNumber.'","'.$email.'","'.$hireDate.'","Active","Crew Member")';
    $result=$conn->query($sql);
    $empID=$conn->insert_id;
    $sql2='INSERT INTO EmployeePersonalData(SSN,EmployeeID,StreetAddress,APTNumber,CITY,USState,ZipCode,DOB)Values("'.$ssn.'",'.$empID.',"'.$address.'","'.$aptNumber.'","'$city'","'.$state.',"'$dob'")';
    //Address,APTNumber,City,State,ZipCode,
    $result2=$conn->query($sql2);
    $sql3='INSERT INTO EmployeeLOG(EmployeeID,PasswordHash)Values('.$empID.',"'.hash("md5",$empPass).'")';
    $result3=$conn->query($sql3);
    echo '<script>window.location.replace("manage.php");</script>';
}else{
    echo '<script>window.location.replace("/");</script>';
}

?>
<html>
    <body></body>    
</html>