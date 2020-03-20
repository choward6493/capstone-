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

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/

$usernamePP = $_POST["uname"];
//echo $usernamePP."<br/>";
//$_POST["psw"];
//echo $_POST["remember"]."<br/>";

$hashPass = hash("md5",$_POST["psw"]);
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$phoneNumber = $_POST["phoneNumber"];
$address = $_POST["address"];
$aptNumber = $_POST["aptNumber"];
$city = $_POST["city"];
$state = $_POST["states"];
console_log($state);
$zipCode = $_POST["zipCode"];
$date=$_POST["date"];
$userID=0;

$sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
//echo $sql;
//$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
$result = $conn->query($sql);
//check duplicate email
if ($result->num_rows > 0) {
    echo '<script>alert("That email has been used before. Please use a different one");window.location.replace("join.php");</script>';
} else {
    //if not duplicate insert into customers
    $sql = 'INSERT INTO Customers(FirstName,LastName,PhoneNumber,Email,Address,APTNumber,City,State,ZipCode,DOB)values("'.$firstName.'","'.$lastName.'","'.$phoneNumber.'","'.$usernamePP.'","'.$address.'","'.$aptNumber.'","'.$city.'","'.$state.'","'.$zipCode.'","'.$date.'")';
    $result = $conn->query($sql);
    console_log($result);
    //get customerID for password storage
    $sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
    $result = $conn->query($sql);
    console_log($result);
    if ($result->num_rows > 0) {
        // output userID from email
        $userID=$result->fetch_assoc()["CustomerID"];
        //echo $result->fetch_assoc()["CustomerID"].'<br>';
    } else {
        //echo "0 results";
    }

    $sql2 = 'INSERT INTO CustomerLOG(CustomerID,CustomerPasswordHash)values("'.$userID.'","'.$hashPass.'")';
    
    $result2 = $conn->query($sql2);
    console_log($result2);

    $userCookie="user";
    $userCookieVal=$usernamePP;
    $passCookie="token";
    $passCookieVal=$hashedData;
    setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
    setcookie($passCookie,$passCookieVal,time()+(86400/24),"/");
        
    //echo '<script>window.location.replace("main.php");</script>';
}



$conn->close();
//window.location.replace("main.php");
?>
<html>
<script></script>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>