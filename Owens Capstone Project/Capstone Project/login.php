<html>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->


<?php
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
echo $usernamePP."<br/>";
//$_POST["psw"];
//$_POST["remember"];

$hashPass = hash("md5",$_POST["psw"])
$userID=0;
$sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
//echo $sql;
//$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output userID from email
    $userID=$result->fetch_assoc()["CustomerID"];
    echo $result->fetch_assoc()["CustomerID"].'<br>';
} else {
    echo "0 results";
}
$sql = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID="'.$userID.'"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output userID from email
    if($hashPass==$result->fetch_assoc()["CustomerID"]){
        echo "You're in"
    }
} else {
    echo "Password not right";
}

$conn->close();
?>




</body>
</html>