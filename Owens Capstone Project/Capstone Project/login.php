<html>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->


<?php
$servername = "capstone2.cxiblbeokqky.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "SixGuys1CapstoneProject";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

</body>
</html>