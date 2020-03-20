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
//echo $usernamePP."<br/>";
//$_POST["psw"];
//echo $_POST["remember"]."<br/>";

$hashPass = hash("md5",$_POST["psw"]);
$userID=0;
$sql = 'SELECT CustomerID FROM Customers WHERE Email="'.$usernamePP.'"';
//echo $sql;
//$sql = 'SELECT CustomerID, Email FROM Customers WHERE Email="arenninger@student.cscc.edu"';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output userID from email
    $userID=$result->fetch_assoc()["CustomerID"];
    //echo $result->fetch_assoc()["CustomerID"].'<br>';
} else {
    //echo "0 results";
}
$sql2 = 'SELECT CustomerPasswordHash FROM CustomerLOG WHERE CustomerID='.$userID;
//echo $sql2;
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    // output userID from email
    $hashedData=$result2->fetch_assoc()["CustomerPasswordHash"];
    //echo '<br>'.$hashedData.'<br>';
    //echo '<br>'.$hashPass;
    if($hashPass==$hashedData){
        //echo "You're in";
        $userCookie="user";
        $userCookieVal=$usernamePP;
        $passCookie="token";
        $passCookieVal=$hashedData;
        if(!($_POST["remember"]=="on")){
            setcookie($userCookie,$userCookieVal, time() + (86400/24), "/");
            setcookie($passCookie,$passCookieVal,time()+(86400/24),"/");
        }else{
            setcookie($userCookie, $userCookieVal, time() + (86400*30), "/");
            setcookie($passCookie,$passCookieVal,time()+(86400*30),"/");
        }
        
    }else {
        //echo "Password not right";
    }
} else {
    //echo "nothing found";
}


$conn->close();
?>
<html>
<script>window.location.replace("main.php");</script>
<body>

<!-- 
search in customer table where CustomerEmail=uname  
if hashed psw = hashed psw in table then give session cookie that expires
$_POST["uname"];
hash('md5', $_POST["psw"];);
-->




</body>
</html>