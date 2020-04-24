<?php 
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
$servername = "capstone2.cxiblbeokqky.us-east-1.rds.amazonaws.com:1433";
$username = "admin";
$password = "SixGuys1CapstoneProject";
$dbname="Capstone";


//INSERT INTO Employees(FirstName,LastName,PhoneNumber,Email,Status,HireDate,Title,AccessCode)Values("Test","Dummy","614-999-9999","arenninger@student.cscc.edu","Hired","2020-01-01","Manager","123456")
//INSERT INTO EmployeeLOG(EmployeeID,PasswordHash)values(1,"343b1c4a3ea721b2d640fc8700db0f36")



// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$cart=$_POST["cart"];
console_log("cart object:");
console_log($cart);
?>