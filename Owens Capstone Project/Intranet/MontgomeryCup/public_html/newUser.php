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

$sql='INSERT INTO Employees(FirstName,LastName,PhoneNumber,Email,HireDate,Status,Title)Values("'.$fname.'","'.$lname.'","'.$phoneNumber.'","'.$email.'","'.$hireDate.'","Active","Crew Member")';
$result=$conn->query($sql);
$userID=$conn->insert_id;
$sql2='INSERT INTO EmployeePersonalData(SSN,EmployeeID,StreetAddress,APTNumber,CITY,USState,ZipCode,DOB)Values("'.$ssn.'",'.$userID.',"'.$address.'","'.$aptNumber.'","'$city'","'.$state.',"'$dob'")';
//Address,APTNumber,City,State,ZipCode,
$result2=$conn->query($sql2);

?>
<html>
    <body></body>    
</html>