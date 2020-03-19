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

// Create connection
$conn = new mysqli($servername, $username, $password);

/*

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

*/

$usernamePP = $_POST["uname"];
//$_POST["psw"];
//$_POST["remember"];

$hashPass = hash("md5",$_POST["psw"])
$sql = "SELECT CustomerID, Email FROM Customers WHERE Email=$usernamePP";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "CustomerID: " . $row["CustomerID"]. " - Name: " . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>




</body>
</html>